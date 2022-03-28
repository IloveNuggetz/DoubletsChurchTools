<?php

namespace App\Model;

use OpenApi\Annotations as OA;

class DoubletReason
{
    private $dissimilarityScore;

    /**
     * @OA\Property(property="similarityParadigmsApplied", description="Array of similarity paradigms that were applied", type="array",
     *      @OA\Items(type="string")
     *)
     */
    private $similarityParadigmsApplied;

    /**
     * @OA\Property(property="semanticRulesApplied", description="Array of semantic rules that were applied", type="array",
     *      @OA\Items(type="string")
     *)
     */
    private $semanticRulesApplied;

    /**
     * @OA\Property(property="details", description="More detailed info on comparison process result", type="array",
     *      @OA\Items(type="float")
     *)
     */
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
