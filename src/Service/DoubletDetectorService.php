<?php

namespace App\Service;

use App\Model\CumulatedDissimilarityResult;
use App\Model\Doublet;
use App\Model\DoubletDetectableInterface;
use App\Model\DoubletDetectorResult;
use App\Model\DoubletReason;
use Psr\Log\LoggerInterface;

class DoubletDetectorService
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function detectDoublets($objectsDataSet, $dissimilarityScoreCutoff, $paradigmsToApply, $semanticRulesToApply)
    {
        set_time_limit(60);

        $doubletsRelevantResults = [];
        $originalInputRelevantResults = [];

        $highestL = 0;
        $lowestL = 1;

        for ($currentObjectIndex = 0; $currentObjectIndex < count($objectsDataSet); ++$currentObjectIndex) {
            $objectData = $objectsDataSet[$currentObjectIndex];
            $objectVarsMap = $objectData->getVarsToDoubletDetect();

            for ($i = $currentObjectIndex + 1; $i < count($objectsDataSet); ++$i) {
                $referenceObjectData = $objectsDataSet[$i];
                $referenceObjectVarMap = $referenceObjectData->getVarsToDoubletDetect();

                $cumulatedDissimilarityResult = $this->calcCumulatedDissimilarityScore($objectVarsMap, $referenceObjectVarMap);

                $cumulatedDissimilarityScore = $cumulatedDissimilarityResult->getCumulatedDissimilarityScore();
                $cumulatedLevenshteinScore = $cumulatedDissimilarityResult->getCumulatedLevenshteinScore();
                $stringsComparedCount = $cumulatedDissimilarityResult->getStringsComparedCount();
                $cumulatedWeightFactor = $cumulatedDissimilarityResult->getCumulatedWeightFactor();

                $avgDissimilarityString = 0;
                if ($stringsComparedCount > 0) {
                    $avgDissimilarityString = $cumulatedDissimilarityScore / $stringsComparedCount;

                    //if weighting is active this will bring values back to 0...1
                    //TODO: make weighting optional setting
                    $avgDissimilarityString = $avgDissimilarityString * ($stringsComparedCount / $cumulatedWeightFactor);

                    if ($highestL < $avgDissimilarityString) {
                        $highestL = $avgDissimilarityString;
                        //$this->logger->info($highestL);
                    }
                    if ($lowestL > $avgDissimilarityString) {
                        $lowestL = $avgDissimilarityString;
                        $this->logger->info($lowestL);
                    }
                } else {
                    throw new NotFoundException('No comparable data provided!');
                }

                if ($avgDissimilarityString <= $dissimilarityScoreCutoff) {
                    //TODO: improve response format to include details of single comparison scores
                    // also sort doublets by dissimilarityScore and with that implement a static maximum and a settable maximum/minimum of doublets to be shown
                    // make upper limit of cutoff settable but no higher than 0.4 e.g.
                    $currentPotentialDoublet = new Doublet($currentObjectIndex, $i, new DoubletReason($avgDissimilarityString, $paradigmsToApply, $semanticRulesToApply, ['Levenshtein' => $cumulatedLevenshteinScore, 'Weight' => $cumulatedWeightFactor, 'StringsCompared' => $stringsComparedCount]));
                    $doubletsRelevantResults[$currentObjectIndex][$i] = $currentPotentialDoublet;
                    $originalInputRelevantResults[$currentObjectIndex] = $objectsDataSet[$currentObjectIndex];
                    $originalInputRelevantResults[$i] = $objectsDataSet[$i];
                }
            }
        }

        //TODO: Maybe use more paradigms here

        return new DoubletDetectorResult($doubletsRelevantResults, $originalInputRelevantResults);
    }

    public function calcCumulatedDissimilarityScore($objectVarsMap, $referenceObjectVarMap): CumulatedDissimilarityResult
    {
        $cumulatedDissimilarityScore = 0;
        $cumulatedLevenshteinScore = 0;
        $stringsComparedCount = 0;
        $cumulatedWeightFactor = 0;

        foreach ($objectVarsMap as $objectVar => $objectVarVal) {
            //Everything except dates, ints and varchar(255) e.g. password
            //TODO: might need to convert everything to string to compare integer fields and dates

            if (is_string($objectVarVal)) {
                $referenceObjectVarVal = $referenceObjectVarMap[$objectVar];

                $levenshteinScore = $this->calcLevenshteinScore($objectVarVal, $referenceObjectVarVal, true);

                $weightFactor = $this->getSemanticWeightFactor($objectVar);

                if (null == $objectVarVal || null == $referenceObjectVarVal) {
                    //rather ignore null values right now.
                    //TODO: might use them in complex semantic rules (two records complete each others nulls -> good indicator for doublet)
                    $weightFactor = $weightFactor * 1 / 10;
                }

                //TODO: make weighting optional setting
                $dissimilarityScore = $levenshteinScore * $weightFactor;

                $cumulatedDissimilarityScore = $cumulatedDissimilarityScore + $dissimilarityScore;
                $cumulatedLevenshteinScore = $cumulatedLevenshteinScore + $levenshteinScore;
                $cumulatedWeightFactor = $cumulatedWeightFactor + $weightFactor;
                ++$stringsComparedCount;
            } elseif ($objectVarVal instanceof DoubletDetectableInterface) {
                $referenceObjectVarVal = $referenceObjectVarMap[$objectVar];
                $nestedObjectResult = $this->calcCumulatedDissimilarityScore($objectVarVal->getVarsToDoubletDetect(), $referenceObjectVarVal->getVarsToDoubletDetect());

                $cumulatedDissimilarityScore = $cumulatedDissimilarityScore + $nestedObjectResult->getCumulatedDissimilarityScore();
                $cumulatedLevenshteinScore = $cumulatedLevenshteinScore + $nestedObjectResult->getCumulatedLevenshteinScore();
                $cumulatedWeightFactor = $cumulatedWeightFactor + $nestedObjectResult->getCumulatedWeightFactor();
                $stringsComparedCount = $stringsComparedCount + $nestedObjectResult->getStringsComparedCount();
            }
        }

        $cumulatedDissimilarityResult = new CumulatedDissimilarityResult($cumulatedDissimilarityScore, $cumulatedLevenshteinScore, $stringsComparedCount, $cumulatedWeightFactor);

        return $cumulatedDissimilarityResult;
    }

    public function calcLevenshteinScore($value, $referenceValue, $lengthNormalized): float
    {
        $levenshteinScore = levenshtein($value, $referenceValue, 1, 1, 1);

        $totalCharactersCount = mb_strlen($value) + mb_strlen($referenceValue);

        //get levenshteinScore normalized to per character
        if ($totalCharactersCount > 0 && $lengthNormalized) {
            $levenshteinScore = $levenshteinScore / $totalCharactersCount;
        }

        return $levenshteinScore;
    }

    public function getSemanticWeightFactor($variableName): float
    {
        //TODO: Use mapping data provided by requesting user to find semantically weightable fields. use enum for weightable logical fields.
        switch ($variableName) {
                        /*
                        case "beruf": $weightFactor = 200000;break;
                        case "geburtsname": $weightFactor = 200000;break;
                        case "geburtsort": $weightFactor = 200000;break;
                        case "nationalitaet": $weightFactor = 200000;break;
                        case "taufort": $weightFactor = 200000;break;
                        case "getauftdurch": $weightFactor = 200000;break;
                        case "land": $weightFactor = 200000;break;
                        */
                        case 'geolatLoose': $weightFactor = 1 / 1000; break;
                        case 'geolngLoose': $weightFactor = 1 / 1000; break;
                        case 'imageurl': $weightFactor = 1; break;
                        case 'familyimageurl': $weightFactor = 1 / 2; break;
                        case 'guid': $weightFactor = 1; break;
                        case 'name': $weightFactor = 1 / 100; break;
                        case 'vorname': $weightFactor = 1 / 200; break;
                        case 'spitzname': $weightFactor = 1 / 200; break;
                        case 'strasse': $weightFactor = 1; break;
                        case 'plz': $weightFactor = 1 / 3000; break;
                        case 'ort': $weightFactor = 1 / 8000; break;
                        case 'telefonprivat': $weightFactor = 1 / 2; break;
                        case 'telefongeschaeftlich': $weightFactor = 1; break;
                        case 'telefonhandy': $weightFactor = 1; break;
                        case 'fax': $weightFactor = 1; break;
                        case 'email': $weightFactor = 1; break;
                        case 'geolat': $weightFactor = 1; break;
                        case 'geolng': $weightFactor = 1; break;
                        default: $weightFactor = 1;
        }

        return $weightFactor;
    }
}
