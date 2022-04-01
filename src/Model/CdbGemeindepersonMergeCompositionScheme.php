<?php

namespace App\Model;

use OpenApi\Annotations as OA;

//TODO: This should get auto generated
/**
 *         @OA\Schema (
 *              type="object",
 *              required={"person", "beruf", "geburtsname", "geburtsdatum", "geburtsort", "nationalitaet", "nationalitaetId", "familienstandNo", "hochzeitsdatum", "station", "status", "erstkontakt", "zugehoerig", "eintrittsdatum", "austrittsgrund", "austrittsdatum", "taufdatum", "taufort", "getauftdurch", "ueberwiesenvon", "ueberwiesennach", "imageurl", "familyimageurl", "growpathId", "letzteaenderung", "aenderunguser", "gev"}
 *         )
 */
class CdbGemeindepersonMergeCompositionScheme extends AbstractMergeCompositionScheme
{
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

    public function getPerson(): CdbPersonMergeCompositionScheme
    {
        return $this->person;
    }

    public function setBeruf($beruf)
    {
        $this->beruf = $beruf;

        return $this;
    }

    public function setGeburtsname($geburtsname)
    {
        $this->geburtsname = $geburtsname;

        return $this;
    }

    public function setGeburtsdatum($geburtsdatum)
    {
        $this->geburtsdatum = $geburtsdatum;

        return $this;
    }

    public function setGeburtsort($geburtsort)
    {
        $this->geburtsort = $geburtsort;

        return $this;
    }

    public function setNationalitaet($nationalitaet)
    {
        $this->nationalitaet = $nationalitaet;

        return $this;
    }

    public function setNationalitaetId($nationalitaetId)
    {
        $this->nationalitaetId = $nationalitaetId;

        return $this;
    }

    public function setFamilienstandNo($familienstandNo)
    {
        $this->familienstandNo = $familienstandNo;

        return $this;
    }

    public function setHochzeitsdatum($hochzeitsdatum)
    {
        $this->hochzeitsdatum = $hochzeitsdatum;

        return $this;
    }

    public function setErstkontakt($erstkontakt)
    {
        $this->erstkontakt = $erstkontakt;

        return $this;
    }

    public function setZugehoerig($zugehoerig)
    {
        $this->zugehoerig = $zugehoerig;

        return $this;
    }

    public function setEintrittsdatum($eintrittsdatum)
    {
        $this->eintrittsdatum = $eintrittsdatum;

        return $this;
    }

    public function setAustrittsgrund($austrittsgrund)
    {
        $this->austrittsgrund = $austrittsgrund;

        return $this;
    }

    public function setAustrittsdatum($austrittsdatum)
    {
        $this->austrittsdatum = $austrittsdatum;

        return $this;
    }

    public function setTaufdatum($taufdatum)
    {
        $this->taufdatum = $taufdatum;

        return $this;
    }

    public function setTaufort($taufort)
    {
        $this->taufort = $taufort;

        return $this;
    }

    public function setGetauftdurch($getauftdurch)
    {
        $this->getauftdurch = $getauftdurch;

        return $this;
    }

    public function setUeberwiesenvon($ueberwiesenvon)
    {
        $this->ueberwiesenvon = $ueberwiesenvon;

        return $this;
    }

    public function setUeberwiesennach($ueberwiesennach)
    {
        $this->ueberwiesennach = $ueberwiesennach;

        return $this;
    }

    public function setImageurl($imageurl)
    {
        $this->imageurl = $imageurl;

        return $this;
    }

    public function setFamilyimageurl($familyimageurl)
    {
        $this->familyimageurl = $familyimageurl;

        return $this;
    }

    public function setGrowpathId($growpathId)
    {
        $this->growpathId = $growpathId;

        return $this;
    }

    public function setLetzteaenderung($letzteaenderung)
    {
        $this->letzteaenderung = $letzteaenderung;

        return $this;
    }

    public function setAenderunguser($aenderunguser)
    {
        $this->aenderunguser = $aenderunguser;

        return $this;
    }

    public function setGev($gev)
    {
        $this->gev = $gev;

        return $this;
    }

    public function setStation($station)
    {
        $this->station = $station;

        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function setPerson(CdbPersonMergeCompositionScheme $person)
    {
        $this->person = $person;

        return $person;
    }
}
