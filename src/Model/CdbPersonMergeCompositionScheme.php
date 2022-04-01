<?php

namespace App\Model;

use OpenApi\Annotations as OA;

//TODO: make model better to validator check that fields here are either firstId or secondId
//could use inheritance of requests and abstract class maybe
/**
 *         @OA\Schema (
 *              type="object",
 *              required={"guid", "name", "vorname", "spitzname", "activeYn", "password", "loginstr", "lastlogin", "loginerrorcount", "acceptedsecurity", "geschlechtNo", "titel", "strasse", "plz", "ort", "land", "zusatz", "telefonprivat", "telefongeschaeftlich", "telefonhandy", "fax", "email", "geolat", "geolng", "geolatLoose", "geolngLoose", "cmsuserid", "archivYn", "optigemNr", "datasecuritymailDate", "privacyPolicyAgreementDate", "privacyPolicyAgreementTypeId", "privacyPolicyAgreementWhoId", "createdate", "letzteaenderung", "aenderunguser", "isSystemUser"}
 *         )
 */
class CdbPersonMergeCompositionScheme extends AbstractMergeCompositionScheme
{
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

    public function setGuid($guid)
    {
        $this->guid = $guid;

        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setVorname($vorname)
    {
        $this->vorname = $vorname;

        return $this;
    }

    public function setSpitzname($spitzname)
    {
        $this->spitzname = $spitzname;

        return $this;
    }

    public function setActiveYn($activeYn)
    {
        $this->activeYn = $activeYn;

        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function setLoginstr($loginstr)
    {
        $this->loginstr = $loginstr;

        return $this;
    }

    public function setLastlogin($lastlogin)
    {
        $this->lastlogin = $lastlogin;

        return $this;
    }

    public function setLoginerrorcount($loginerrorcount)
    {
        $this->loginerrorcount = $loginerrorcount;

        return $this;
    }

    public function setAcceptedsecurity($acceptedsecurity)
    {
        $this->acceptedsecurity = $acceptedsecurity;

        return $this;
    }

    public function setGeschlechtNo($geschlechtNo)
    {
        $this->geschlechtNo = $geschlechtNo;

        return $this;
    }

    public function setTitel($titel)
    {
        $this->titel = $titel;

        return $this;
    }

    public function setStrasse($strasse)
    {
        $this->strasse = $strasse;

        return $this;
    }

    public function setPlz($plz)
    {
        $this->plz = $plz;

        return $this;
    }

    public function setOrt($ort)
    {
        $this->ort = $ort;

        return $this;
    }

    public function setLand($land)
    {
        $this->land = $land;

        return $this;
    }

    public function setZusatz($zusatz)
    {
        $this->zusatz = $zusatz;

        return $this;
    }

    public function setTelefonprivat($telefonprivat)
    {
        $this->telefonprivat = $telefonprivat;

        return $this;
    }

    public function setTelefongeschaeftlich($telefongeschaeftlich)
    {
        $this->telefongeschaeftlich = $telefongeschaeftlich;

        return $this;
    }

    public function setTelefonhandy($telefonhandy)
    {
        $this->telefonhandy = $telefonhandy;

        return $this;
    }

    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function setGeolat($geolat)
    {
        $this->geolat = $geolat;

        return $this;
    }

    public function setGeolng($geolng)
    {
        $this->geolng = $geolng;

        return $this;
    }

    public function setGeolatLoose($geolatLoose)
    {
        $this->geolatLoose = $geolatLoose;

        return $this;
    }

    public function setGeolngLoose($geolngLoose)
    {
        $this->geolngLoose = $geolngLoose;

        return $this;
    }

    public function setCmsuserid($cmsuserid)
    {
        $this->cmsuserid = $cmsuserid;

        return $this;
    }

    public function setArchivYn($archivYn)
    {
        $this->archivYn = $archivYn;

        return $this;
    }

    public function setOptigemNr($optigemNr)
    {
        $this->optigemNr = $optigemNr;

        return $this;
    }

    public function setDatasecuritymailDate($datasecuritymailDate)
    {
        $this->datasecuritymailDate = $datasecuritymailDate;

        return $this;
    }

    public function setPrivacyPolicyAgreementDate($privacyPolicyAgreementDate)
    {
        $this->privacyPolicyAgreementDate = $privacyPolicyAgreementDate;

        return $this;
    }

    public function setPrivacyPolicyAgreementTypeId($privacyPolicyAgreementTypeId)
    {
        $this->privacyPolicyAgreementTypeId = $privacyPolicyAgreementTypeId;

        return $this;
    }

    public function setPrivacyPolicyAgreementWhoId($privacyPolicyAgreementWhoId)
    {
        $this->privacyPolicyAgreementWhoId = $privacyPolicyAgreementWhoId;

        return $this;
    }

    public function setCreatedate($createdate)
    {
        $this->createdate = $createdate;

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

    public function setIsSystemUser($isSystemUser)
    {
        $this->isSystemUser = $isSystemUser;

        return $this;
    }
}
