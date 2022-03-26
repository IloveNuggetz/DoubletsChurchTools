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
        $personRepo = $this->personRepo;
        $dns = $this->dns;
        $ddds = $this->ddds;

        //Only compare person - person | gemeindeperson - gemeindeperson
        $persons = $personRepo->findAll();
        $gemeindepersons = $gemeindepersonRepo->findAll();

        $logger->info(count($gemeindepersons));
        $logger->info(count($persons));

        foreach ($gemeindepersons as $gemeindeperson) {
            $gemeindeperson = $this->normalizeGemeindeperson($gemeindeperson, $logger, $dns);
        }

        foreach ($persons as $person) {
            $person = $this->normalizePerson($person, $logger, $dns);
        }

        $gemeindepersonDoublets = $this->ddds->detectDoublets($gemeindepersons, 2, ['Levenshtein-distance', 'Other doublet paradigms'], ['Possibly semantic domaindriven rules here']);
        //$personDoublets = $this->ddds->detectDoublets($persons, 2, ['Levenshtein-distance', 'Other doublet paradigms'], ['Possibly semantic domaindriven rules here']);
        $personDoublets = [];

        $doublets = ['Gemeindepersons' => $gemeindepersonDoublets, 'Persons' => $personDoublets];

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

    //This function needs an interface for object, to ensure that getObjectVars and set are available
    //Could also normalize dates and maybe mobile numbers
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

    public function mergePersons($mergeRequestArray): CdbPerson
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

        $person = $personRepo->findOneBy(['id' => $mergeRequestArray['firstId']]);
        $person2 = $personRepo->findOneBy(['id' => $mergeRequestArray['secondId']]);

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
