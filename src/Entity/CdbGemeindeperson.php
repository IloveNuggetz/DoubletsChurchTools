<?php

namespace App\Entity;

use App\Model\DoubletDetectableInterface;
use App\Model\NormalizableInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

/**
 * CdbGemeindeperson.
 *
 * @ORM\Table(name="cdb_gemeindeperson", indexes={@ORM\Index(name="status_id", columns={"status_id"}), @ORM\Index(name="station_id", columns={"station_id"}), @ORM\Index(name="person_id", columns={"person_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CdbGemeindepersonRepository")
 */
class CdbGemeindeperson implements NormalizableInterface, DoubletDetectableInterface
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
     * @var string
     *
     * @ORM\Column(name="beruf", type="string", length=50, nullable=false)
     */
    private $beruf;

    /**
     * @var string
     *
     * @ORM\Column(name="geburtsname", type="string", length=30, nullable=false)
     */
    private $geburtsname;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="geburtsdatum", type="datetime", nullable=true)
     */
    private $geburtsdatum;

    /**
     * @var string
     *
     * @ORM\Column(name="geburtsort", type="string", length=30, nullable=false)
     */
    private $geburtsort;

    /**
     * @var string
     *
     * @ORM\Column(name="nationalitaet", type="string", length=30, nullable=false)
     */
    private $nationalitaet;

    /**
     * @var int
     *
     * @ORM\Column(name="nationalitaet_id", type="integer", nullable=false)
     */
    private $nationalitaetId = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="familienstand_no", type="integer", nullable=false)
     */
    private $familienstandNo = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="hochzeitsdatum", type="datetime", nullable=true)
     */
    private $hochzeitsdatum;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="erstkontakt", type="datetime", nullable=true)
     */
    private $erstkontakt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="zugehoerig", type="datetime", nullable=true)
     */
    private $zugehoerig;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="eintrittsdatum", type="datetime", nullable=true)
     */
    private $eintrittsdatum;

    /**
     * @var string
     *
     * @ORM\Column(name="austrittsgrund", type="string", length=10, nullable=false)
     */
    private $austrittsgrund;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="austrittsdatum", type="datetime", nullable=true)
     */
    private $austrittsdatum;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="taufdatum", type="datetime", nullable=true)
     */
    private $taufdatum;

    /**
     * @var string
     *
     * @ORM\Column(name="taufort", type="string", length=50, nullable=false)
     */
    private $taufort;

    /**
     * @var string
     *
     * @ORM\Column(name="getauftdurch", type="string", length=50, nullable=false)
     */
    private $getauftdurch;

    /**
     * @var string
     *
     * @ORM\Column(name="ueberwiesenvon", type="string", length=30, nullable=false)
     */
    private $ueberwiesenvon;

    /**
     * @var string
     *
     * @ORM\Column(name="ueberwiesennach", type="string", length=30, nullable=false)
     */
    private $ueberwiesennach;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imageurl", type="string", length=64, nullable=true)
     */
    private $imageurl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="familyimageurl", type="string", length=64, nullable=true)
     */
    private $familyimageurl;

    /**
     * @var int|null
     *
     * @ORM\Column(name="growpath_id", type="integer", nullable=true)
     */
    private $growpathId;

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
     * @var int|null
     *
     * @ORM\Column(name="GEV", type="integer", nullable=true)
     */
    private $gev;

    /**
     * @var \CdbStation
     *
     * @ORM\ManyToOne(targetEntity="CdbStation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="station_id", referencedColumnName="id")
     * })
     *@Ignore
     */
    private $station;

    /**
     * @var \CdbStatus
     *
     * @ORM\ManyToOne(targetEntity="CdbStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     * })
     *@Ignore
     */
    private $status;

    /**
     * @var \CdbPerson
     *
     * @ORM\ManyToOne(targetEntity="CdbPerson")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     * })
     */
    private $person;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeruf(): ?string
    {
        return $this->beruf;
    }

    public function setBeruf(string $beruf): self
    {
        $this->beruf = $beruf;

        return $this;
    }

    public function getGeburtsname(): ?string
    {
        return $this->geburtsname;
    }

    public function setGeburtsname(string $geburtsname): self
    {
        $this->geburtsname = $geburtsname;

        return $this;
    }

    public function getGeburtsdatum(): ?\DateTimeInterface
    {
        return $this->geburtsdatum;
    }

    public function setGeburtsdatum(?\DateTimeInterface $geburtsdatum): self
    {
        $this->geburtsdatum = $geburtsdatum;

        return $this;
    }

    public function getGeburtsort(): ?string
    {
        return $this->geburtsort;
    }

    public function setGeburtsort(string $geburtsort): self
    {
        $this->geburtsort = $geburtsort;

        return $this;
    }

    public function getNationalitaet(): ?string
    {
        return $this->nationalitaet;
    }

    public function setNationalitaet(string $nationalitaet): self
    {
        $this->nationalitaet = $nationalitaet;

        return $this;
    }

    public function getNationalitaetId(): ?int
    {
        return $this->nationalitaetId;
    }

    public function setNationalitaetId(int $nationalitaetId): self
    {
        $this->nationalitaetId = $nationalitaetId;

        return $this;
    }

    public function getFamilienstandNo(): ?int
    {
        return $this->familienstandNo;
    }

    public function setFamilienstandNo(int $familienstandNo): self
    {
        $this->familienstandNo = $familienstandNo;

        return $this;
    }

    public function getHochzeitsdatum(): ?\DateTimeInterface
    {
        return $this->hochzeitsdatum;
    }

    public function setHochzeitsdatum(?\DateTimeInterface $hochzeitsdatum): self
    {
        $this->hochzeitsdatum = $hochzeitsdatum;

        return $this;
    }

    public function getErstkontakt(): ?\DateTimeInterface
    {
        return $this->erstkontakt;
    }

    public function setErstkontakt(?\DateTimeInterface $erstkontakt): self
    {
        $this->erstkontakt = $erstkontakt;

        return $this;
    }

    public function getZugehoerig(): ?\DateTimeInterface
    {
        return $this->zugehoerig;
    }

    public function setZugehoerig(?\DateTimeInterface $zugehoerig): self
    {
        $this->zugehoerig = $zugehoerig;

        return $this;
    }

    public function getEintrittsdatum(): ?\DateTimeInterface
    {
        return $this->eintrittsdatum;
    }

    public function setEintrittsdatum(?\DateTimeInterface $eintrittsdatum): self
    {
        $this->eintrittsdatum = $eintrittsdatum;

        return $this;
    }

    public function getAustrittsgrund(): ?string
    {
        return $this->austrittsgrund;
    }

    public function setAustrittsgrund(string $austrittsgrund): self
    {
        $this->austrittsgrund = $austrittsgrund;

        return $this;
    }

    public function getAustrittsdatum(): ?\DateTimeInterface
    {
        return $this->austrittsdatum;
    }

    public function setAustrittsdatum(?\DateTimeInterface $austrittsdatum): self
    {
        $this->austrittsdatum = $austrittsdatum;

        return $this;
    }

    public function getTaufdatum(): ?\DateTimeInterface
    {
        return $this->taufdatum;
    }

    public function setTaufdatum(?\DateTimeInterface $taufdatum): self
    {
        $this->taufdatum = $taufdatum;

        return $this;
    }

    public function getTaufort(): ?string
    {
        return $this->taufort;
    }

    public function setTaufort(string $taufort): self
    {
        $this->taufort = $taufort;

        return $this;
    }

    public function getGetauftdurch(): ?string
    {
        return $this->getauftdurch;
    }

    public function setGetauftdurch(string $getauftdurch): self
    {
        $this->getauftdurch = $getauftdurch;

        return $this;
    }

    public function getUeberwiesenvon(): ?string
    {
        return $this->ueberwiesenvon;
    }

    public function setUeberwiesenvon(string $ueberwiesenvon): self
    {
        $this->ueberwiesenvon = $ueberwiesenvon;

        return $this;
    }

    public function getUeberwiesennach(): ?string
    {
        return $this->ueberwiesennach;
    }

    public function setUeberwiesennach(string $ueberwiesennach): self
    {
        $this->ueberwiesennach = $ueberwiesennach;

        return $this;
    }

    public function getImageurl(): ?string
    {
        return $this->imageurl;
    }

    public function setImageurl(?string $imageurl): self
    {
        $this->imageurl = $imageurl;

        return $this;
    }

    public function getFamilyimageurl(): ?string
    {
        return $this->familyimageurl;
    }

    public function setFamilyimageurl(?string $familyimageurl): self
    {
        $this->familyimageurl = $familyimageurl;

        return $this;
    }

    public function getGrowpathId(): ?int
    {
        return $this->growpathId;
    }

    public function setGrowpathId(?int $growpathId): self
    {
        $this->growpathId = $growpathId;

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

    public function getGev(): ?int
    {
        return $this->gev;
    }

    public function setGev(?int $gev): self
    {
        $this->gev = $gev;

        return $this;
    }

    public function getStation(): ?CdbStation
    {
        return $this->station;
    }

    public function setStation(?CdbStation $station): self
    {
        $this->station = $station;

        return $this;
    }

    public function getStatus(): ?CdbStatus
    {
        return $this->status;
    }

    public function setStatus(?CdbStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPerson(): ?CdbPerson
    {
        return $this->person;
    }

    public function setPerson(?CdbPerson $person): self
    {
        $this->person = $person;

        return $this;
    }

    /**
     * @Ignore
     */
    public function getVarsToNormalize()
    {
        return get_object_vars($this);
    }

    /**
     * @Ignore
     */
    public function setNormalizedVars($normalizedVarsMap)
    {
        foreach ($normalizedVarsMap as $objectVar => $objectVarVal) {
            $this->{$objectVar} = $objectVarVal;
        }
    }

    /**
     * @Ignore
     */
    public function getVarsToDoubletDetect()
    {
        return get_object_vars($this);
    }
}
