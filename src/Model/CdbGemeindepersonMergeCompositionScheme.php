<?php

namespace App\Model;

use OpenApi\Annotations as OA;

//TODO: This should get auto generated
/**
 *         @OA\Schema (
 *              type="object",
 *              required={"id"}
 *         )
 */
class CdbGemeindepersonMergeCompositionScheme
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $beruf;

    /**
     * @var int
     */
    private $geburtsname;

    /**
     * @var int
     */
    private $geburtsdatum;

    /**
     * @var int
     */
    private $geburtsort;

    /**
     * @var int
     */
    private $nationalitaet;

    /**
     * @var int
     */
    private $nationalitaetId;

    /**
     * @var int
     */
    private $familienstandNo;

    /**
     * @var int
     */
    private $hochzeitsdatum;

    /**
     * @var int
     */
    private $erstkontakt;

    /**
     * @var int
     */
    private $zugehoerig;

    /**
     * @var int
     */
    private $eintrittsdatum;

    /**
     * @var int
     */
    private $austrittsgrund;

    /**
     * @var int
     */
    private $austrittsdatum;

    /**
     * @var int
     */
    private $taufdatum;

    /**
     * @var int
     */
    private $taufort;

    /**
     * @var int
     */
    private $getauftdurch;

    /**
     * @var int
     */
    private $ueberwiesenvon;

    /**
     * @var int
     */
    private $ueberwiesennach;

    /**
     * @var int
     */
    private $imageurl;

    /**
     * @var int
     */
    private $familyimageurl;

    /**
     * @var int
     */
    private $growpathId;

    /**
     * @var int
     */
    private $letzteaenderung;

    /**
     * @var int
     */
    private $aenderunguser;

    /**
     * @var int
     */
    private $gev;

    /**
     * @var int
     */
    private $station;

    /**
     * @var int
     */
    private $status;

    //Always merge Gemeindeperson together with its 1:1 related person
    /**
     * @var CdbPersonMergeCompositionScheme
     */
    private $person;

    public function getId()
    {
        return $this->id;
    }

    public function getBeruf()
    {
        return $this->beruf;
    }

    public function getGeburtsname()
    {
        return $this->geburtsname;
    }

    public function getGeburtsdatum()
    {
        return $this->geburtsdatum;
    }

    public function getGeburtsort()
    {
        return $this->geburtsort;
    }

    public function getNationalitaet()
    {
        return $this->nationalitaet;
    }

    public function getNationalitaetId()
    {
        return $this->nationalitaetId;
    }

    public function getFamilienstandNo()
    {
        return $this->familienstandNo;
    }

    public function getHochzeitsdatum()
    {
        return $this->hochzeitsdatum;
    }

    public function getErstkontakt()
    {
        return $this->erstkontakt;
    }

    public function getZugehoerig()
    {
        return $this->zugehoerig;
    }

    public function getEintrittsdatum()
    {
        return $this->eintrittsdatum;
    }

    public function getAustrittsgrund()
    {
        return $this->austrittsgrund;
    }

    public function getAustrittsdatum()
    {
        return $this->austrittsdatum;
    }

    public function getTaufdatum()
    {
        return $this->taufdatum;
    }

    public function getTaufort()
    {
        return $this->taufort;
    }

    public function getGetauftdurch()
    {
        return $this->getauftdurch;
    }

    public function getUeberwiesenvon()
    {
        return $this->ueberwiesenvon;
    }

    public function getUeberwiesennach()
    {
        return $this->ueberwiesennach;
    }

    public function getImageurl()
    {
        return $this->imageurl;
    }

    public function getFamilyimageurl()
    {
        return $this->familyimageurl;
    }

    public function getGrowpathId()
    {
        return $this->growpathId;
    }

    public function getLetzteaenderung()
    {
        return $this->letzteaenderung;
    }

    public function getAenderunguser()
    {
        return $this->aenderunguser;
    }

    public function getGev()
    {
        return $this->gev;
    }

    public function getStation()
    {
        return $this->station;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getPerson()
    {
        return $this->person;
    }
}
