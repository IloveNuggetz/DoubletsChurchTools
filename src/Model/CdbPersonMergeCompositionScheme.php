<?php

namespace App\Model;

use OpenApi\Annotations as OA;

//TODO: make model better to validator check that fields here are either firstId or secondId
//could use inheritance of requests and abstract class maybe
/**
 *         @OA\Schema (
 *              type="object",
 *              required={"id"}
 *         )
 */
class CdbPersonMergeCompositionScheme
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $guid;

    /**
     * @var int
     */
    private $name;

    /**
     * @var int
     */
    private $vorname;

    /**
     * @var int
     */
    private $spitzname;

    /**
     * @var int
     */
    private $activeYn;

    /**
     * @var int
     */
    private $password;

    /**
     * @var int
     */
    private $loginstr;

    /**
     * @var int
     */
    private $lastlogin;

    /**
     * @var int
     */
    private $loginerrorcount;

    /**
     * @var int
     */
    private $acceptedsecurity;

    /**
     * @var int
     */
    private $geschlechtNo;

    /**
     * @var int
     */
    private $titel;

    /**
     * @var int
     */
    private $strasse;

    /**
     * @var int
     */
    private $plz;

    /**
     * @var int
     */
    private $ort;

    /**
     * @var int
     */
    private $land;

    /**
     * @var int
     */
    private $zusatz;

    /**
     * @var int
     */
    private $telefonprivat;

    /**
     * @var int
     */
    private $telefongeschaeftlich;

    /**
     * @var int
     */
    private $telefonhandy;

    /**
     * @var int
     */
    private $fax;

    /**
     * @var int
     */
    private $email;

    /**
     * @var int
     */
    private $geolat;

    /**
     * @var int
     */
    private $geolng;

    /**
     * @var int
     */
    private $geolatLoose;

    /**
     * @var int
     */
    private $geolngLoose;

    /**
     * @var int
     */
    private $cmsuserid;

    /**
     * @var int
     */
    private $archivYn;

    /**
     * @var int
     */
    private $optigemNr;

    /**
     * @var int
     */
    private $datasecuritymailDate;

    /**
     * @var int
     */
    private $privacyPolicyAgreementDate;

    /**
     * @var int
     */
    private $privacyPolicyAgreementTypeId;

    /**
     * @var int
     */
    private $privacyPolicyAgreementWhoId;

    /**
     * @var int
     */
    private $createdate;

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
    private $isSystemUser;

    public function getId()
    {
        return $this->id;
    }

    public function getGuid()
    {
        return $this->guid;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getVorname()
    {
        return $this->vorname;
    }

    public function getSpitzname()
    {
        return $this->spitzname;
    }

    public function getActiveYn()
    {
        return $this->activeYn;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getLoginstr()
    {
        return $this->loginstr;
    }

    public function getLastlogin()
    {
        return $this->lastlogin;
    }

    public function getLoginerrorcount()
    {
        return $this->loginerrorcount;
    }

    public function getAcceptedsecurity()
    {
        return $this->acceptedsecurity;
    }

    public function getGeschlechtNo()
    {
        return $this->geschlechtNo;
    }

    public function getTitel()
    {
        return $this->titel;
    }

    public function getStrasse()
    {
        return $this->strasse;
    }

    public function getPlz()
    {
        return $this->plz;
    }

    public function getOrt()
    {
        return $this->ort;
    }

    public function getLand()
    {
        return $this->land;
    }

    public function getZusatz()
    {
        return $this->zusatz;
    }

    public function getTelefonprivat()
    {
        return $this->telefonprivat;
    }

    public function getTelefongeschaeftlich()
    {
        return $this->telefongeschaeftlich;
    }

    public function getTelefonhandy()
    {
        return $this->telefonhandy;
    }

    public function getFax()
    {
        return $this->fax;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getGeolat()
    {
        return $this->geolat;
    }

    public function getGeolng()
    {
        return $this->geolng;
    }

    public function getGeolatLoose()
    {
        return $this->geolatLoose;
    }

    public function getGeolngLoose()
    {
        return $this->geolngLoose;
    }

    public function getCmsuserid()
    {
        return $this->cmsuserid;
    }

    public function getArchivYn()
    {
        return $this->archivYn;
    }

    public function getOptigemNr()
    {
        return $this->optigemNr;
    }

    public function getDatasecuritymailDate()
    {
        return $this->datasecuritymailDate;
    }

    public function getPrivacyPolicyAgreementDate()
    {
        return $this->privacyPolicyAgreementDate;
    }

    public function getPrivacyPolicyAgreementTypeId()
    {
        return $this->privacyPolicyAgreementTypeId;
    }

    public function getPrivacyPolicyAgreementWhoId()
    {
        return $this->privacyPolicyAgreementWhoId;
    }

    public function getCreatedate()
    {
        return $this->createdate;
    }

    public function getLetzteaenderung()
    {
        return $this->letzteaenderung;
    }

    public function getAenderunguser()
    {
        return $this->aenderunguser;
    }

    public function getIsSystemUser()
    {
        return $this->isSystemUser;
    }
}
