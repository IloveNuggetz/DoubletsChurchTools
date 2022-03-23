<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CcAddresses.
 *
 * @ORM\Table(name="cc_addresses")
 * @ORM\Entity()
 */
class CcAddresses
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
