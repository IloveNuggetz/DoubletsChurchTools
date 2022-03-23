<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CdbPerson.
 *
 * @ORM\Table(name="cdb_person", uniqueConstraints={@ORM\UniqueConstraint(name="guid", columns={"guid"})})
 * @ORM\Entity(repositoryClass="App\Repository\CdbPersonRepository")
 */
class CdbPerson
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="guid", type="string", length=40, nullable=true)
     */
    private $guid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=30, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="vorname", type="string", length=30, nullable=false)
     */
    private $vorname;

    /**
     * @var string
     *
     * @ORM\Column(name="spitzname", type="string", length=30, nullable=false)
     */
    private $spitzname;

    /**
     * @var int
     *
     * @ORM\Column(name="active_yn", type="integer", nullable=false, options={"default"="1"})
     */
    private $activeYn = 1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="loginstr", type="string", length=255, nullable=true)
     */
    private $loginstr;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="lastlogin", type="datetime", nullable=true)
     */
    private $lastlogin;

    /**
     * @var int
     *
     * @ORM\Column(name="loginerrorcount", type="integer", nullable=false)
     */
    private $loginerrorcount;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="acceptedsecurity", type="datetime", nullable=true)
     */
    private $acceptedsecurity;

    /**
     * @var int
     *
     * @ORM\Column(name="geschlecht_no", type="integer", nullable=false)
     */
    private $geschlechtNo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="titel", type="string", length=30, nullable=false)
     */
    private $titel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="strasse", type="string", length=100, nullable=true)
     */
    private $strasse;

    /**
     * @var string
     *
     * @ORM\Column(name="plz", type="string", length=20, nullable=false)
     */
    private $plz;

    /**
     * @var string
     *
     * @ORM\Column(name="ort", type="string", length=40, nullable=false)
     */
    private $ort;

    /**
     * @var string
     *
     * @ORM\Column(name="land", type="string", length=30, nullable=false)
     */
    private $land;

    /**
     * @var string|null
     *
     * @ORM\Column(name="zusatz", type="string", length=100, nullable=true)
     */
    private $zusatz;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonprivat", type="string", length=30, nullable=false)
     */
    private $telefonprivat;

    /**
     * @var string
     *
     * @ORM\Column(name="telefongeschaeftlich", type="string", length=20, nullable=false)
     */
    private $telefongeschaeftlich;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonhandy", type="string", length=20, nullable=false)
     */
    private $telefonhandy;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=20, nullable=false)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="geolat", type="string", length=20, nullable=false)
     */
    private $geolat;

    /**
     * @var string
     *
     * @ORM\Column(name="geolng", type="string", length=20, nullable=false)
     */
    private $geolng;

    /**
     * @var string|null
     *
     * @ORM\Column(name="geolat_loose", type="string", length=20, nullable=true)
     */
    private $geolatLoose;

    /**
     * @var string|null
     *
     * @ORM\Column(name="geolng_loose", type="string", length=20, nullable=true)
     */
    private $geolngLoose;

    /**
     * @var string
     *
     * @ORM\Column(name="cmsuserid", type="string", length=50, nullable=false)
     */
    private $cmsuserid;

    /**
     * @var int
     *
     * @ORM\Column(name="archiv_yn", type="integer", nullable=false)
     */
    private $archivYn = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="optigem_nr", type="string", length=30, nullable=false)
     */
    private $optigemNr;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="datasecuritymail_date", type="datetime", nullable=true)
     */
    private $datasecuritymailDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="privacy_policy_agreement_date", type="datetime", nullable=true)
     */
    private $privacyPolicyAgreementDate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="privacy_policy_agreement_type_id", type="integer", nullable=true)
     */
    private $privacyPolicyAgreementTypeId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="privacy_policy_agreement_who_id", type="integer", nullable=true)
     */
    private $privacyPolicyAgreementWhoId;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="createdate", type="datetime", nullable=true)
     */
    private $createdate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="letzteaenderung", type="datetime", nullable=true)
     */
    private $letzteaenderung;

    /**
     * @var int|null
     *
     * @ORM\Column(name="aenderunguser", type="integer", nullable=true)
     */
    private $aenderunguser;

    /**
     * @var int
     *
     * @ORM\Column(name="is_system_user", type="integer", nullable=false)
     */
    private $isSystemUser = '0';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGuid(): ?string
    {
        return $this->guid;
    }

    public function setGuid(?string $guid): self
    {
        $this->guid = $guid;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getVorname(): ?string
    {
        return $this->vorname;
    }

    public function setVorname(string $vorname): self
    {
        $this->vorname = $vorname;

        return $this;
    }

    public function getSpitzname(): ?string
    {
        return $this->spitzname;
    }

    public function setSpitzname(string $spitzname): self
    {
        $this->spitzname = $spitzname;

        return $this;
    }

    public function getActiveYn(): ?int
    {
        return $this->activeYn;
    }

    public function setActiveYn(int $activeYn): self
    {
        $this->activeYn = $activeYn;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getLoginstr(): ?string
    {
        return $this->loginstr;
    }

    public function setLoginstr(?string $loginstr): self
    {
        $this->loginstr = $loginstr;

        return $this;
    }

    public function getLastlogin(): ?\DateTimeInterface
    {
        return $this->lastlogin;
    }

    public function setLastlogin(?\DateTimeInterface $lastlogin): self
    {
        $this->lastlogin = $lastlogin;

        return $this;
    }

    public function getLoginerrorcount(): ?int
    {
        return $this->loginerrorcount;
    }

    public function setLoginerrorcount(int $loginerrorcount): self
    {
        $this->loginerrorcount = $loginerrorcount;

        return $this;
    }

    public function getAcceptedsecurity(): ?\DateTimeInterface
    {
        return $this->acceptedsecurity;
    }

    public function setAcceptedsecurity(?\DateTimeInterface $acceptedsecurity): self
    {
        $this->acceptedsecurity = $acceptedsecurity;

        return $this;
    }

    public function getGeschlechtNo(): ?int
    {
        return $this->geschlechtNo;
    }

    public function setGeschlechtNo(int $geschlechtNo): self
    {
        $this->geschlechtNo = $geschlechtNo;

        return $this;
    }

    public function getTitel(): ?string
    {
        return $this->titel;
    }

    public function setTitel(string $titel): self
    {
        $this->titel = $titel;

        return $this;
    }

    public function getStrasse(): ?string
    {
        return $this->strasse;
    }

    public function setStrasse(?string $strasse): self
    {
        $this->strasse = $strasse;

        return $this;
    }

    public function getPlz(): ?string
    {
        return $this->plz;
    }

    public function setPlz(string $plz): self
    {
        $this->plz = $plz;

        return $this;
    }

    public function getOrt(): ?string
    {
        return $this->ort;
    }

    public function setOrt(string $ort): self
    {
        $this->ort = $ort;

        return $this;
    }

    public function getLand(): ?string
    {
        return $this->land;
    }

    public function setLand(string $land): self
    {
        $this->land = $land;

        return $this;
    }

    public function getZusatz(): ?string
    {
        return $this->zusatz;
    }

    public function setZusatz(?string $zusatz): self
    {
        $this->zusatz = $zusatz;

        return $this;
    }

    public function getTelefonprivat(): ?string
    {
        return $this->telefonprivat;
    }

    public function setTelefonprivat(string $telefonprivat): self
    {
        $this->telefonprivat = $telefonprivat;

        return $this;
    }

    public function getTelefongeschaeftlich(): ?string
    {
        return $this->telefongeschaeftlich;
    }

    public function setTelefongeschaeftlich(string $telefongeschaeftlich): self
    {
        $this->telefongeschaeftlich = $telefongeschaeftlich;

        return $this;
    }

    public function getTelefonhandy(): ?string
    {
        return $this->telefonhandy;
    }

    public function setTelefonhandy(string $telefonhandy): self
    {
        $this->telefonhandy = $telefonhandy;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getGeolat(): ?string
    {
        return $this->geolat;
    }

    public function setGeolat(string $geolat): self
    {
        $this->geolat = $geolat;

        return $this;
    }

    public function getGeolng(): ?string
    {
        return $this->geolng;
    }

    public function setGeolng(string $geolng): self
    {
        $this->geolng = $geolng;

        return $this;
    }

    public function getGeolatLoose(): ?string
    {
        return $this->geolatLoose;
    }

    public function setGeolatLoose(?string $geolatLoose): self
    {
        $this->geolatLoose = $geolatLoose;

        return $this;
    }

    public function getGeolngLoose(): ?string
    {
        return $this->geolngLoose;
    }

    public function setGeolngLoose(?string $geolngLoose): self
    {
        $this->geolngLoose = $geolngLoose;

        return $this;
    }

    public function getCmsuserid(): ?string
    {
        return $this->cmsuserid;
    }

    public function setCmsuserid(string $cmsuserid): self
    {
        $this->cmsuserid = $cmsuserid;

        return $this;
    }

    public function getArchivYn(): ?int
    {
        return $this->archivYn;
    }

    public function setArchivYn(int $archivYn): self
    {
        $this->archivYn = $archivYn;

        return $this;
    }

    public function getOptigemNr(): ?string
    {
        return $this->optigemNr;
    }

    public function setOptigemNr(string $optigemNr): self
    {
        $this->optigemNr = $optigemNr;

        return $this;
    }

    public function getDatasecuritymailDate(): ?\DateTimeInterface
    {
        return $this->datasecuritymailDate;
    }

    public function setDatasecuritymailDate(?\DateTimeInterface $datasecuritymailDate): self
    {
        $this->datasecuritymailDate = $datasecuritymailDate;

        return $this;
    }

    public function getPrivacyPolicyAgreementDate(): ?\DateTimeInterface
    {
        return $this->privacyPolicyAgreementDate;
    }

    public function setPrivacyPolicyAgreementDate(?\DateTimeInterface $privacyPolicyAgreementDate): self
    {
        $this->privacyPolicyAgreementDate = $privacyPolicyAgreementDate;

        return $this;
    }

    public function getPrivacyPolicyAgreementTypeId(): ?int
    {
        return $this->privacyPolicyAgreementTypeId;
    }

    public function setPrivacyPolicyAgreementTypeId(?int $privacyPolicyAgreementTypeId): self
    {
        $this->privacyPolicyAgreementTypeId = $privacyPolicyAgreementTypeId;

        return $this;
    }

    public function getPrivacyPolicyAgreementWhoId(): ?int
    {
        return $this->privacyPolicyAgreementWhoId;
    }

    public function setPrivacyPolicyAgreementWhoId(?int $privacyPolicyAgreementWhoId): self
    {
        $this->privacyPolicyAgreementWhoId = $privacyPolicyAgreementWhoId;

        return $this;
    }

    public function getCreatedate(): ?\DateTimeInterface
    {
        return $this->createdate;
    }

    public function setCreatedate(?\DateTimeInterface $createdate): self
    {
        $this->createdate = $createdate;

        return $this;
    }

    public function getLetzteaenderung(): ?\DateTimeInterface
    {
        return $this->letzteaenderung;
    }

    public function setLetzteaenderung(?\DateTimeInterface $letzteaenderung): self
    {
        $this->letzteaenderung = $letzteaenderung;

        return $this;
    }

    public function getAenderunguser(): ?int
    {
        return $this->aenderunguser;
    }

    public function setAenderunguser(?int $aenderunguser): self
    {
        $this->aenderunguser = $aenderunguser;

        return $this;
    }

    public function getIsSystemUser(): ?int
    {
        return $this->isSystemUser;
    }

    public function setIsSystemUser(int $isSystemUser): self
    {
        $this->isSystemUser = $isSystemUser;

        return $this;
    }

    public function getObjectVars()
    {
        return get_object_vars($this);
    }

    public function setObjectVars($objectVarsMap)
    {
        foreach ($objectVarsMap as $objectVar => $objectVarVal) {
            $this->{$objectVar} = $objectVarVal;
        }
    }
}
