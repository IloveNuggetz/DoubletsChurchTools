<?php

namespace App\Service;

use App\Entity\CdbPerson;
use App\Repository\CdbGemeindepersonRepository;
use App\Repository\CdbPersonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class DoubletsService
{
    private $gemeindepersonRepo;
    private $personRepo;
    private $dns;
    private $ddds;
    private $logger;
    private $em;

    public function __construct(CdbGemeindepersonRepository $gemeindepersonRepo, CdbPersonRepository $personRepo, DataNormalizationService $dns, DataDoubletDetectorService $ddds, LoggerInterface $logger, EntityManagerInterface $em)
    {
        $this->gemeindepersonRepo = $gemeindepersonRepo;
        $this->personRepo = $personRepo;
        $this->dns = $dns;
        $this->ddds = $ddds;
        $this->logger = $logger;
        $this->em = $em;
    }

    public function getExistingDoublets()
    {
        //TODO: only re-search doublets if DB has changed

        $logger = $this->logger;
        $gemeindepersonRepo = $this->gemeindepersonRepo;
        $dns = $this->dns;
        $ddds = $this->ddds;

        $gemeindepersons = $gemeindepersonRepo->findAll();

        foreach ($gemeindepersons as $gemeindeperson) {
            $gemeindeperson = $this->normalizeGemeindeperson($gemeindeperson, $logger, $dns);
        }

        $gemeindepersonDoublets = $this->ddds->detectDoublets($gemeindepersons, 0.15, ['Length-Normalized-Levenshtein-distance', 'Other doublet paradigms'], ['Semantical weighting', 'Possibly semantic domaindriven rules here']);

        $doublets = ['Gemeindepersons' => $gemeindepersonDoublets];

        return $doublets;
    }

    public function normalizeGemeindeperson($gemeindeperson, $logger, $dns)
    {
        $gemeindeperson = $this->normalizeStrings($gemeindeperson, $logger, $dns);

        $person = $gemeindeperson->getPerson();
        $person = $this->normalizePerson($person, $logger, $dns);
        $gemeindeperson->setPerson($person);

        return $gemeindeperson;
    }

    public function normalizePerson($person, $logger, $dns)
    {
        $person = $this->normalizeStrings($person, $logger, $dns);

        $strasse = $person->getStrasse();
        $strasse = $dns->normalizeLexical($strasse, $logger);
        $person->setStrasse($strasse);

        return $person;
    }

    //TODO: Could also normalize dates and maybe mobile numbers
    public function normalizeStrings($object, $logger, $dns)
    {
        $objectVarsMap = $object->getVarsToNormalize();

        foreach ($objectVarsMap as $objectVar => $objectVarVal) {
            if (is_string($objectVarVal)) {
                $objectVarVal = $dns->normalizeCharacters($objectVarVal, $logger);
                $objectVarsMap[$objectVar] = $objectVarVal;
            }
        }

        $object->setNormalizedVars($objectVarsMap);

        return $object;
    }

    public function mergePersons($mergeRequest): CdbPerson
    {
        $personRepo = $this->personRepo;
        $em = $this->em;

        //Check if ids are valid for merge
        $validForMerge = true;

        if (!$validForMerge) {
            throw $this->createNotFoundException('The given ids are not applicable for merging!');
        }

        $newFusionedEntity = new CdbPerson();
        $newFusionedEntity->setName('George');

        $person = $personRepo->findOneBy(['id' => $mergeRequest->getFirstId()]);
        $person2 = $personRepo->findOneBy(['id' => $mergeRequest->getSecondId()]);

        /*
        $em->transactional(function($em) {
            $em->remove($person);
            $em->remove($person2);

            $em->persist($newFusionedEntity);
        });
        */

        return $newFusionedEntity;
    }
}
