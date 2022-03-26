<?php

namespace App\Model;

class DoubletDetectorResult
{
    private $doublets;
    private $objectsData;

    public function getDoublets()
    {
        return $this->doublets;
    }

    public function setDoublets($doublets): self
    {
        $this->doublets = $doublets;

        return $this;
    }

    public function getObjectsData()
    {
        return $this->objectsData;
    }

    public function setOriginalInput($objectsData): self
    {
        $this->objectsData = $objectsData;

        return $this;
    }

    public function __construct($doublets, $objectsData)
    {
        $this->doublets = $doublets;
        $this->objectsData = $objectsData;
    }
}
