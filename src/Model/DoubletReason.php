<?php

namespace App\Model;

class DoubletReason
{
    private $dissimilarityScore;
    private $similarityParadigmsApplied;
    private $semanticRulesApplied;
    private $details;

    public function getDissimilarityScore(): float
    {
        return $this->dissimilarityScore;
    }

    public function setDissimilarityScore(float $dissimilarityScore): self
    {
        $this->dissimilarityScore = $dissimilarityScore;

        return $this;
    }

    public function getSimilarityParadigmsApplied()
    {
        return $this->similarityParadigmsApplied;
    }

    public function setSimilarityParadigmsApplied($similarityParadigmsApplied): self
    {
        $this->similarityParadigmsApplied = $similarityParadigmsApplied;

        return $this;
    }

    public function getSemanticRulesApplied()
    {
        return $this->semanticRulesApplied;
    }

    public function setSemanticRulesApplied($semanticRulesApplied): self
    {
        $this->semanticRulesApplied = $semanticRulesApplied;

        return $this;
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function setDetails($details): self
    {
        $this->details = $details;

        return $this;
    }

    public function __construct(float $dissimilarityScore, $similarityParadigmsApplied, $semanticRulesApplied, $details)
    {
        $this->dissimilarityScore = $dissimilarityScore;
        $this->similarityParadigmsApplied = $similarityParadigmsApplied;
        $this->semanticRulesApplied = $semanticRulesApplied;
        $this->details = $details;
    }
}
