<?php

namespace App\Model;

class Doublet
{
    private $baseObjectIndex;
    private $referenceObjectIndex;
    private $reason;

    public function getBaseObjectIndex(): ?int
    {
        return $this->baseObjectIndex;
    }

    public function setBaseObjectIndex(int $baseObjectIndex): self
    {
        $this->baseObjectIndex = $baseObjectIndex;

        return $this;
    }

    public function getReferenceObjectIndex(): ?int
    {
        return $this->referenceObjectIndex;
    }

    public function setReferenceObjectIndex(int $referenceObjectIndex): self
    {
        $this->referenceObjectIndex = $referenceObjectIndex;

        return $this;
    }

    public function getReason(): DoubletReason
    {
        return $this->reason;
    }

    public function setReason(DoubletReason $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function __construct($baseObjectIndex, $referenceObjectIndex, DoubletReason $reason)
    {
        $this->baseObjectIndex = $baseObjectIndex;
        $this->referenceObjectIndex = $referenceObjectIndex;
        $this->reason = $reason;
    }
}
