<?php

namespace App\Model;

class Doublet
{
    private $baseObjectIndex;
    private $referenceObjectIndex;
    private $reason;

    public function getBaseObject(): ?int
    {
        return $this->baseObjectIndex;
    }

    public function setBaseObject(int $baseObjectIndex): self
    {
        $this->baseObjectIndex = $baseObjectIndex;

        return $this;
    }

    public function getReferenceObject(): ?int
    {
        return $this->referenceObjectIndex;
    }

    public function setReferenceObject(int $referenceObjectIndex): self
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
