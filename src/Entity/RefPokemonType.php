<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RefPokemonType
 *
 * @ORM\Table(name="ref_pokemon_type", indexes={@ORM\Index(name="IDX_5483EF99564D586", columns={"type_2"}), @ORM\Index(name="IDX_5483EF999C6D843C", columns={"type_1"})})
 * @ORM\Entity(repositoryClass="App\Repository\RefPokemonTypeRepository")
 */
class RefPokemonType
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
     * @var int|null
     *
     * @ORM\Column(name="type_2", type="integer", nullable=true)
     */
    private $type2;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var bool
     *
     * @ORM\Column(name="evolution", type="boolean", nullable=false)
     */
    private $evolution;

    /**
     * @var bool
     *
     * @ORM\Column(name="starter", type="boolean", nullable=false)
     */
    private $starter;

    /**
     * @var string
     *
     * @ORM\Column(name="type_courbe_niveau", type="string", length=1, nullable=false, options={"fixed"=true})
     */
    private $typeCourbeNiveau;

    /**
     * @var \RefElementaryType
     *
     * @ORM\ManyToOne(targetEntity="RefElementaryType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_1", referencedColumnName="id")
     * })
     */
    private $type1;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType2(): ?int
    {
        return $this->type2;
    }

    public function setType2(?int $type2): self
    {
        $this->type2 = $type2;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEvolution(): ?bool
    {
        return $this->evolution;
    }

    public function setEvolution(bool $evolution): self
    {
        $this->evolution = $evolution;

        return $this;
    }

    public function getStarter(): ?bool
    {
        return $this->starter;
    }

    public function setStarter(bool $starter): self
    {
        $this->starter = $starter;

        return $this;
    }

    public function getTypeCourbeNiveau(): ?string
    {
        return $this->typeCourbeNiveau;
    }

    public function setTypeCourbeNiveau(string $typeCourbeNiveau): self
    {
        $this->typeCourbeNiveau = $typeCourbeNiveau;

        return $this;
    }

    public function getType1(): ?RefElementaryType
    {
        return $this->type1;
    }

    public function setType1(?RefElementaryType $type1): self
    {
        $this->type1 = $type1;

        return $this;
    }


}
