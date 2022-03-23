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
    private $logger;
    private $em;

    public function __construct(CdbGemeindepersonRepository $gemeindepersonRepo, CdbPersonRepository $personRepo, DataNormalizationService $dns, LoggerInterface $logger, EntityManagerInterface $em)
    {
        $this->gemeindepersonRepo = $gemeindepersonRepo;
        $this->personRepo = $personRepo;
        $this->dns = $dns;
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

        $gemeindepersons = $gemeindepersonRepo->findAll();

        $logger->info(count($gemeindepersons));

        //Gleiche für alle Personen nicht nur gemeindepersonen
        $this->normalizeGemeindepersons($gemeindepersons, $logger, $dns);

        $map = [];

        for ($i = 0; $i < count($gemeindepersons); ++$i) {
            $person = $gemeindepersons[$i]->getPerson();
            $strasse = $person->getStrasse();
            //$logger->info($i);

            if (!is_null($strasse)) {
                $id = $person->getId();

                if (!array_key_exists($strasse, $map)) {
                    $map[$strasse] = [$id];
                } else {
                    if (in_array($id, $map[$strasse])) {
                        $logger->info($strasse);
                        $logger->info('got it');
                    }

                    array_push($map[$strasse], $id);
                }
            }
        }

        return $map;
    }

    public function normalizeGemeindepersons($gemeindepersons, $logger, $dns)
    {
        $specialChars = [];

        foreach ($gemeindepersons as $gemeindeperson) {
            $strasse = $gemeindeperson->getPerson()->getStrasse();
            $strasse = $dns->normalizeCharacters($strasse, $logger);
            $strasse = $dns->normalizeLexical($strasse, $logger);

            $gemeindeperson->getPerson()->setStrasse($strasse);

            /*
            $str = $gemeindeperson->getPerson()->getName();
            $specialChars = $this->normalizeCharacters($str, $logger);


            $str = $gemeindeperson->getPerson()->getVorname();
            $specialChars = $this->cv_input($str, $logger, $specialChars);

            $str = $gemeindeperson->getBeruf();
            $specialChars = $this->cv_input($str, $logger, $specialChars);

            $str = $gemeindeperson->getPerson()->getTitel();
            $specialChars = $this->cv_input($str, $logger, $specialChars);

            $str = $gemeindeperson->getPerson()->getOrt();
            $specialChars = $this->cv_input($str, $logger, $specialChars);

            $str = $gemeindeperson->getPerson()->getLand();
            $specialChars = $this->cv_input($str, $logger, $specialChars);

            $str = $gemeindeperson->getPerson()->getEmail();
            $specialChars = $this->cv_input($str, $logger, $specialChars);
            */
        }

        return $gemeindepersons;
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
