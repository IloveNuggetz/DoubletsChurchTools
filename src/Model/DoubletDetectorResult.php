<?php

namespace App\Model;

use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;

class DoubletDetectorResult
{
    /**
     * @OA\Property(property="doublets", description="Array of possible doublets", type="array",
     *      @OA\Items(ref=@Model(type=Doublet::class))
     *)
     */
    private $doublets;

    /**
     * @OA\Property(property="objects data", description="Array of objects that doublets are based on", type="array",
     *      @OA\Items(type="object")
     *)
     */
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

    public function setObjectsData($objectsData): self
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
