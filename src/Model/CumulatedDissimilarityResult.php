<?php

namespace App\Model;

class CumulatedDissimilarityResult
{
    private $cumulatedDissimilarityScore;
    private $cumulatedLevenshteinScore;
    private $stringsComparedCount;
    private $cumulatedWeightFactor;

    public function getCumulatedDissimilarityScore(): float
    {
        return $this->cumulatedDissimilarityScore;
    }

    public function setCumulatedDissimilarityScore(float $cumulatedDissimilarityScore): self
    {
        $this->cumulatedDissimilarityScore = $cumulatedDissimilarityScore;

        return $this;
    }

        public function getCumulatedLevenshteinScore(): float
        {
            return $this->cumulatedLevenshteinScore;
        }

        public function setCumulatedLevenshteinScore(float $cumulatedLevenshteinScore): self
        {
            $this->cumulatedLevenshteinScore = $cumulatedLevenshteinScore;

            return $this;
        }

    public function getStringsComparedCount()
    {
        return $this->stringsComparedCount;
    }

    public function setStringsComparedCount($stringsComparedCount): self
    {
        $this->stringsComparedCount = $stringsComparedCount;

        return $this;
    }

    public function getCumulatedWeightFactor(): float
    {
        return $this->cumulatedWeightFactor;
    }

    public function setCumulatedWeightFactor(float $cumulatedWeightFactor): self
    {
        $this->cumulatedWeightFactor = $cumulatedWeightFactor;

        return $this;
    }

    public function __construct(float $cumulatedDissimilarityScore, float $cumulatedLevenshteinScore, int $stringsComparedCount, float $cumulatedWeightFactor)
    {
        $this->cumulatedDissimilarityScore = $cumulatedDissimilarityScore;
        $this->cumulatedLevenshteinScore = $cumulatedLevenshteinScore;
        $this->stringsComparedCount = $stringsComparedCount;
        $this->cumulatedWeightFactor = $cumulatedWeightFactor;
    }
}
