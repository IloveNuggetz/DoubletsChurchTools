<?php

namespace App\Entity;

use App\Entity\CdbPerson;
use App\Entity\DoubletReason;

use OpenApi\Annotations as OA;


class Doublet
{

    private $firstPerson;
    private $secondPerson;
    private $reason;

    public function getFirstPerson(): CdbPerson
    {
        return $this->firstPerson;
    }

    public function setFirstPerson(CdbPerson $firstPerson): self
    {
        $this->firstPerson = $firstPerson;

        return $this;
    }

    public function getSecondPerson(): CdbPerson
    {
        return $this->secondPerson;
    }

    public function setSecondPerson(CdbPerson $secondPerson): self
    {
        $this->secondPerson = $secondPerson;

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

    function __construct(CdbPerson $firstPerson, CdbPerson $secondPerson, DoubletReason $reason) {

        $this->firstPerson = $firstPerson;
        $this->secondPerson = $secondPerson;
        $this->reason = $reason;
    }

}