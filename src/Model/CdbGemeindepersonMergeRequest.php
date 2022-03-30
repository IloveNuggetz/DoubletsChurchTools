<?php

namespace App\Model;

use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;

/**
 *         @OA\Schema (
 *              type="object",
 *              required={"firstId", "secondId", "mergeScheme"}
 *         )
 */
class CdbGemeindepersonMergeRequest
{
    /**
     * @OA\Property(property="firstId", description="Id of first person to merge", type="integer")
     */
    private $firstId;

    /**
     * @OA\Property(property="secondId", description="Id of second person to merge", type="integer")
     */
    private $secondId;

    /**
     *  @OA\Property(property="mergeScheme", description="Schema how to merge", ref=@Model(type="App\Model\CdbGemeindepersonMergeCompositionScheme"))
     */
    private $mergeScheme;

    public function getFirstId()
    {
        return $this->firstId;
    }

    public function getSecondId()
    {
        return $this->secondId;
    }

    public function getMergeScheme(): CdbGemeindepersonMergeCompositionScheme
    {
        return $this->mergeScheme;
    }

    public function setFirstId($firstId)
    {
        $this->firstId = $firstId;

        return $this;
    }

    public function setSecondId($secondId)
    {
        $this->secondId = $secondId;

        return $this;
    }

    public function setMergeScheme(CdbGemeindepersonMergeCompositionScheme $mergeScheme)
    {
        $this->mergeScheme = $mergeScheme;

        return $this;
    }
}
