<?php

namespace App\Service;

use App\Model\Doublet;
use App\Model\DoubletDetectableInterface;
use App\Model\DoubletDetectorResult;
use App\Model\DoubletReason;
use Psr\Log\LoggerInterface;

class DataDoubletDetectorService
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function detectDoublets($objectsDataSet, $dissimilarityScoreCutoff, $paradigmsToApply, $semanticRulesToApply)
    {
        set_time_limit(60);
        /*
            for ($i = 0; $i < count($objectsDataSet); ++$i) {
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
                */

        $doubletsRelevantResults = [];
        $originalInputRelevantResults = [];

        for ($currentObjectIndex = 0; $currentObjectIndex < count($objectsDataSet); ++$currentObjectIndex) {
            $objectData = $objectsDataSet[$currentObjectIndex];
            $objectVarsMap = $objectData->getVarsToDoubletDetect();

            for ($i = $currentObjectIndex + 1; $i < count($objectsDataSet); ++$i) {
                $referenceObjectData = $objectsDataSet[$i];
                $referenceObjectVarMap = $referenceObjectData->getVarsToDoubletDetect();

                $cumulatedLevenshteinScore = $this->calcCumulatedLevenshteinScore($objectVarsMap, $referenceObjectVarMap);

                if ($cumulatedLevenshteinScore <= $dissimilarityScoreCutoff) {
                    //similarityScore inflates with more strings. gotta normalize this
                    $currentPotentialDoublet = new Doublet($currentObjectIndex, $i, new DoubletReason($cumulatedLevenshteinScore, $paradigmsToApply, $semanticRulesToApply, ['Levenshtein' => $cumulatedLevenshteinScore]));
                    $doubletsRelevantResults[$currentObjectIndex][$i] = $currentPotentialDoublet;
                    $originalInputRelevantResults[$currentObjectIndex] = $objectsDataSet[$currentObjectIndex];
                    $originalInputRelevantResults[$i] = $objectsDataSet[$i];
                }
            }
            //$this->logger->info($currentObjectIndex);
        }
        //$this->logger->info(count($doubletsRelevantResults));

        return new DoubletDetectorResult($doubletsRelevantResults, $originalInputRelevantResults);
    }

    public function calcCumulatedLevenshteinScore($objectVarsMap, $referenceObjectVarMap): float
    {
        $cumulatedLevenshteinScore = 0;

        foreach ($objectVarsMap as $objectVar => $objectVarVal) {
            //Everything except dates, ints and varchar(255) e.g. password
            //TODO: might need to convert everything to string to compare integer fields and dates
            // also gotta implement handling complex datatypes here or require only simple datatypes map from start
            if (is_string($objectVarVal)) {
                $referenceObjectVarVal = $referenceObjectVarMap[$objectVar];
                $levenshteinScore = levenshtein($objectVarVal, $referenceObjectVarVal, 1, 1, 1);

                $totalCharactersCount = mb_strlen($objectVarVal) + mb_strlen($referenceObjectVarVal);

                //get similarityScore normalized to per character
                if ($totalCharactersCount > 0) {
                    $levenshteinScore = $levenshteinScore / $totalCharactersCount;

                    $cumulatedLevenshteinScore = $cumulatedLevenshteinScore + $levenshteinScore;
                }
            } elseif ($objectVarVal instanceof DoubletDetectableInterface) {
                $referenceObjectVarVal = $referenceObjectVarMap[$objectVar];
                $cumulatedLevenshteinScore = $cumulatedLevenshteinScore + $this->detectDoublets([$objectVarVal, $referenceObjectVarVal], 100, '', '')->getDoublets()[0][1]->getReason()->getDissimilarityScore();
            }
        }

        return $cumulatedLevenshteinScore;
    }
}
