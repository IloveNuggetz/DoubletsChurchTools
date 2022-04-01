<?php

namespace App\Service;

use App\Model\AbstractMergeCompositionScheme;
use App\Repository\CdbGemeindepersonRepository;
use App\Repository\CdbPersonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class DoubletsService
{
    private $gemeindepersonRepo;
    private $personRepo;
    private $ns;
    private $dds;
    private $logger;
    private $em;

    public function __construct(CdbGemeindepersonRepository $gemeindepersonRepo, CdbPersonRepository $personRepo, NormalizationService $ns, DoubletDetectorService $dds, LoggerInterface $logger, EntityManagerInterface $em)
    {
        $this->gemeindepersonRepo = $gemeindepersonRepo;
        $this->personRepo = $personRepo;
        $this->ns = $ns;
        $this->dds = $dds;
        $this->logger = $logger;
        $this->em = $em;
    }

    public function getDoublets($class)
    {
        //TODO: only re-search doublets if DB has changed

        $logger = $this->logger;
        $ns = $this->ns;
        $dds = $this->dds;
        $em = $this->em;

        $repository = $em->getRepository($class);

        $objects = $repository->findAll();

        foreach ($objects as $object) {
            $object = $this->normalizeGemeindeperson($object, $logger, $ns);
        }

        $objectsDoublets = $this->dds->detectDoublets($objects, 0.15, ['Length-Normalized-Levenshtein-distance', 'Other doublet paradigms'], ['Semantical weighting', 'Possibly semantic domaindriven rules here'], 'id');

        return $objectsDoublets;
    }

    //TODO: move to normalizer service and do generalized
    public function normalizeGemeindeperson($gemeindeperson, $logger, $ns)
    {
        $gemeindeperson = $this->normalizeStrings($gemeindeperson, $logger, $ns);

        $person = $gemeindeperson->getPerson();
        $person = $this->normalizePerson($person, $logger, $ns);
        $gemeindeperson->setPerson($person);

        return $gemeindeperson;
    }

    public function normalizePerson($person, $logger, $ns)
    {
        $person = $this->normalizeStrings($person, $logger, $ns);

        $strasse = $person->getStrasse();
        $strasse = $ns->normalizeLexical($strasse, $logger);
        $person->setStrasse($strasse);

        return $person;
    }

    //TODO: Could also normalize dates and maybe mobile numbers
    public function normalizeStrings($object, $logger, $ns)
    {
        $objectVarsMap = $object->getVarsToNormalize();

        foreach ($objectVarsMap as $objectVar => $objectVarVal) {
            if (is_string($objectVarVal)) {
                $objectVarVal = $ns->normalizeCharacters($objectVarVal, $logger);
                $objectVarsMap[$objectVar] = $objectVarVal;
            }
        }

        $object->setNormalizedVars($objectVarsMap);

        return $object;
    }

    public function mergeEntities($mergeRequest, $class)
    {
        $doubletsResult = $this->getDoublets($class);

        $firstId = $mergeRequest->getFirstId();
        $secondId = $mergeRequest->getSecondId();
        $isValid = $this->isValidMerge($firstId, $secondId, $doubletsResult->getDoublets());

        if (!$isValid) {
            throw new BadRequestHttpException('The given ids are not applicable for merging!');
        } else {
            $objectsData = $doubletsResult->getObjectsData();
            $entitiesToMerge = [$firstId => $objectsData[$firstId]->getVarsToMerge(), $secondId => $objectsData[$secondId]->getVarsToMerge()];

            $mergedObjectEntity = $this->buildMergedEntity($entitiesToMerge, $mergeRequest->getMergeScheme());
            $mergedPersistedEntity = $this->executePersistenceMerge($entitiesToMerge, $mergedObjectEntity);
        }

        return $mergedObjectEntity;
    }

    public function isValidMerge($firstId, $secondId, $doubletsArrayArray)
    {
        $isValid = false;
        //TODO: after redoing the doublet response format this would be just searching all doublet objects for ids. this is not nice.
        //replace index referencing in doublets to id referencing then.
        foreach ($doubletsArrayArray as $baseObjectId => $referenceObjectIds) {
            if (!$isValid) {
                foreach ($referenceObjectIds as $referenceObjectId => $doublet) {
                    $firstIdDoublet = $doublet->getBaseObjectIndex();
                    $secondIdDoublet = $doublet->getReferenceObjectIndex();
                    if (($firstId == $firstIdDoublet && $secondId == $secondIdDoublet) || ($secondId == $firstIdDoublet && $firstId == $secondIdDoublet)) {
                        $isValid = true;
                        break;
                    }
                }
            }
        }

        return $isValid;
    }

    public function buildMergedEntity($entitiesToMerge, $mergeScheme)
    {
        $reflect = new \ReflectionClass($mergeScheme);
        $attributes = $reflect->getProperties();

        $schemeVars = $attributes;

        $mergedEntityVars = [];

        foreach ($schemeVars as $idValueToKeep) {
            $idValueToKeep->setAccessible(true);
            $varName = $idValueToKeep->getName();

            $idValueToKeep = $idValueToKeep->getValue($mergeScheme);

            $this->logger->info($varName);

            $valueToKeep = $this->getValueToKeep($varName, $idValueToKeep, $entitiesToMerge);
            $mergedEntityVars[$varName] = $valueToKeep;
        }

        //Get class of entity that merge scheme is meant to merge
        $class = "App\Entity\\".strstr($reflect->getShortName(), 'MergeCompositionScheme', true);
        $mergedObjectEntity = new $class();
        $mergedObjectEntity->setMergedVars($mergedEntityVars);

        return $mergedObjectEntity;
    }

    public function getValueToKeep($varName, $idValueToKeep, $entitiesToMerge)
    {
        if (is_int($idValueToKeep) && array_key_exists($idValueToKeep, $entitiesToMerge)) {
            $valueToKeep = $entitiesToMerge[$idValueToKeep][$varName];
        } elseif ($idValueToKeep instanceof AbstractMergeCompositionScheme) {
            $nestedEntitiesToMerge = [];
            foreach ($entitiesToMerge as $id => $entityVarVals) {
                $nestedEntitiesToMerge[$id] = $entityVarVals[$varName]->getVarsToMerge();
            }
            $valueToKeep = $this->buildMergedEntity($nestedEntitiesToMerge, $idValueToKeep);
        } else {
            throw new BadRequestHttpException('Invalid request body: Merge scheme Ids need to match Id of entities to merge!');
        }

        return $valueToKeep;
    }

    public function executePersistenceMerge($entitiesToMerge, $mergedObjectEntity)
    {
        $gemeindepersonRepo = $this->gemeindepersonRepo;
        $personRepo = $this->personRepo;
        $em = $this->em;

        //TODO: only specific so far, sometime in far future this could be generalized as well

        $em->getConnection()->beginTransaction(); // suspend auto-commit
        try {
            foreach ($entitiesToMerge as $objectVarsVals) {
                $id = $objectVarsVals['id'];
                $personId = $objectVarsVals['person']->getVarsToMerge()['id'];
                $gemeindeperson = $gemeindepersonRepo->findOneBy(['id' => $id]);
                $person = $personRepo->findOneBy(['id' => $personId]);

                $em->remove($gemeindeperson);
                $em->remove($person);
            }

            $em->flush();

            $em->persist($mergedObjectEntity->getPerson());
            $em->persist($mergedObjectEntity);
            $em->flush();
            $em->getConnection()->commit();
        } catch (Exception $e) {
            $em->getConnection()->rollBack();
            throw $e;
        }

        return $gemeindepersonRepo->findOneBy(['id' => $mergedObjectEntity->getId()]);
    }
}
