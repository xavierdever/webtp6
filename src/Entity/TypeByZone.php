<?php

namespace App\Entity;

use App\Repository\TypeByZoneRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeByZoneRepository::class)
 */
class TypeByZone
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $idZoneCapture;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $idType;


    public function getIdZoneCapture(): ?int
    {
        return $this->idZoneCapture;
    }

    public function setIdZoneCapture(int $idZoneCapture): self
    {
        $this->idZoneCapture = $idZoneCapture;

        return $this;
    }

    public function getIdType(): ?int
    {
        return $this->idType;
    }

    public function setIdType(int $idType): self
    {
        $this->idType = $idType;

        return $this;
    }
}
