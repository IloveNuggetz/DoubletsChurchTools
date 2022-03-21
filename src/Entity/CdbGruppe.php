<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CdbGruppe
 *
 * @ORM\Table(name="cdb_gruppe")
 * @ORM\Entity()
 */
class CdbGruppe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    public function getId(): ?int
    {
        return $this->id;
    }
}