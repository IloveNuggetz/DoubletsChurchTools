<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CdbStation.
 *
 * @ORM\Table(name="cdb_station", indexes={@ORM\Index(name="cdb_station_cc_addresses_id_fk", columns={"address_id"}), @ORM\Index(name="cdb_station_sign_up_group_id_cdb_gruppe_id", columns={"sign_up_group_id"}), @ORM\Index(name="cdb_station_cc_associations_id_fk", columns={"association_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CdbStationRepository")
 */
class CdbStation
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
     * @var string|null
     *
     * @ORM\Column(name="bezeichnung", type="string", length=255, nullable=true)
     */
    private $bezeichnung;

    /**
     * @var string
     *
     * @ORM\Column(name="short_name", type="string", length=20, nullable=false)
     */
    private $shortName;

    /**
     * @var string
     *
     * @ORM\Column(name="kuerzel", type="string", length=10, nullable=false)
     */
    private $kuerzel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="slug", type="string", length=100, nullable=true)
     */
    private $slug;

    /**
     * @var int
     *
     * @ORM\Column(name="sortkey", type="integer", nullable=false)
     */
    private $sortkey = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="profile_type", type="string", length=7, nullable=false, options={"default"="campus"})
     */
    private $profileType = 'campus';

    /**
     * @var bool
     *
     * @ORM\Column(name="is_published", type="boolean", nullable=false)
     */
    private $isPublished = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="denomination", type="string", length=100, nullable=false, options={"default"="denomination.none"})
     */
    private $denomination = 'denomination.none';

    /**
     * @var string
     *
     * @ORM\Column(name="social_media", type="text", length=65535, nullable=false)
     */
    private $socialMedia;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="text", length=65535, nullable=false)
     */
    private $tags;

    /**
     * @var int
     *
     * @ORM\Column(name="visitors", type="integer", nullable=false)
     */
    private $visitors = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="team_title", type="string", length=100, nullable=true)
     */
    private $teamTitle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdDate = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     *
     * @ORM\Column(name="created_pid", type="integer", nullable=false)
     */
    private $createdPid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $modifiedDate = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     *
     * @ORM\Column(name="modified_pid", type="integer", nullable=false)
     */
    private $modifiedPid;

    /**
     * @var \CcAddresses
     *
     * @ORM\ManyToOne(targetEntity="CcAddresses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     * })
     */
    private $address;

    /**
     * @var \CcAssociations
     *
     * @ORM\ManyToOne(targetEntity="CcAssociations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="association_id", referencedColumnName="id")
     * })
     */
    private $association;

    /**
     * @var \CdbGruppe
     *
     * @ORM\ManyToOne(targetEntity="CdbGruppe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sign_up_group_id", referencedColumnName="id")
     * })
     */
    private $signUpGroup;

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

    public function getBezeichnung(): ?string
    {
        return $this->bezeichnung;
    }

    public function setBezeichnung(?string $bezeichnung): self
    {
        $this->bezeichnung = $bezeichnung;

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function setShortName(string $shortName): self
    {
        $this->shortName = $shortName;

        return $this;
    }

    public function getKuerzel(): ?string
    {
        return $this->kuerzel;
    }

    public function setKuerzel(string $kuerzel): self
    {
        $this->kuerzel = $kuerzel;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSortkey(): ?int
    {
        return $this->sortkey;
    }

    public function setSortkey(int $sortkey): self
    {
        $this->sortkey = $sortkey;

        return $this;
    }

    public function getProfileType(): ?string
    {
        return $this->profileType;
    }

    public function setProfileType(string $profileType): self
    {
        $this->profileType = $profileType;

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getDenomination(): ?string
    {
        return $this->denomination;
    }

    public function setDenomination(string $denomination): self
    {
        $this->denomination = $denomination;

        return $this;
    }

    public function getSocialMedia(): ?string
    {
        return $this->socialMedia;
    }

    public function setSocialMedia(string $socialMedia): self
    {
        $this->socialMedia = $socialMedia;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(string $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function getVisitors(): ?int
    {
        return $this->visitors;
    }

    public function setVisitors(int $visitors): self
    {
        $this->visitors = $visitors;

        return $this;
    }

    public function getTeamTitle(): ?string
    {
        return $this->teamTitle;
    }

    public function setTeamTitle(?string $teamTitle): self
    {
        $this->teamTitle = $teamTitle;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getCreatedPid(): ?int
    {
        return $this->createdPid;
    }

    public function setCreatedPid(int $createdPid): self
    {
        $this->createdPid = $createdPid;

        return $this;
    }

    public function getModifiedDate(): ?\DateTimeInterface
    {
        return $this->modifiedDate;
    }

    public function setModifiedDate(\DateTimeInterface $modifiedDate): self
    {
        $this->modifiedDate = $modifiedDate;

        return $this;
    }

    public function getModifiedPid(): ?int
    {
        return $this->modifiedPid;
    }

    public function setModifiedPid(int $modifiedPid): self
    {
        $this->modifiedPid = $modifiedPid;

        return $this;
    }

    public function getAddress(): ?CcAddresses
    {
        return $this->address;
    }

    public function setAddress(?CcAddresses $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAssociation(): ?CcAssociations
    {
        return $this->association;
    }

    public function setAssociation(?CcAssociations $association): self
    {
        $this->association = $association;

        return $this;
    }

    public function getSignUpGroup(): ?CdbGruppe
    {
        return $this->signUpGroup;
    }

    public function setSignUpGroup(?CdbGruppe $signUpGroup): self
    {
        $this->signUpGroup = $signUpGroup;

        return $this;
    }
}
