<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CdbStatus
 *
 * @ORM\Table(name="cdb_status")
 * @ORM\Entity(repositoryClass="App\Repository\CdbStatusRepository")
 */
class CdbStatus
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
     * @ORM\Column(name="bezeichnung", type="string", length=30, nullable=false)
     */
    private $bezeichnung;

    /**
     * @var string
     *
     * @ORM\Column(name="kuerzel", type="string", length=10, nullable=false)
     */
    private $kuerzel;

    /**
     * @var int
     *
     * @ORM\Column(name="mitglied_yn", type="integer", nullable=false)
     */
    private $mitgliedYn;

    /**
     * @var int
     *
     * @ORM\Column(name="infreitextauswahl_yn", type="integer", nullable=false, options={"default"="1"})
     */
    private $infreitextauswahlYn = 1;

    /**
     * @var int
     *
     * @ORM\Column(name="sortkey", type="integer", nullable=false)
     */
    private $sortkey = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="securitylevel_id", type="integer", nullable=false, options={"default"="1"})
     */
    private $securitylevelId = 1;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBezeichnung(): ?string
    {
        return $this->bezeichnung;
    }

    public function setBezeichnung(string $bezeichnung): self
    {
        $this->bezeichnung = $bezeichnung;

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

    public function getMitgliedYn(): ?int
    {
        return $this->mitgliedYn;
    }

    public function setMitgliedYn(int $mitgliedYn): self
    {
        $this->mitgliedYn = $mitgliedYn;

        return $this;
    }

    public function getInfreitextauswahlYn(): ?int
    {
        return $this->infreitextauswahlYn;
    }

    public function setInfreitextauswahlYn(int $infreitextauswahlYn): self
    {
        $this->infreitextauswahlYn = $infreitextauswahlYn;

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

    public function getSecuritylevelId(): ?int
    {
        return $this->securitylevelId;
    }

    public function setSecuritylevelId(int $securitylevelId): self
    {
        $this->securitylevelId = $securitylevelId;

        return $this;
    }


}
