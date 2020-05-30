<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pokemon
 *
 * @ORM\Table(name="pokemon", indexes={@ORM\Index(name="dresseurId_const", columns={"dresseurId"})})
 * @ORM\Entity
 */
class Pokemon
{
    /**
     * @var int
     *
     * @ORM\Column(name="idP", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idp;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=30, nullable=false)
     */
    private $sexe;

    /**
     * @var int
     *
     * @ORM\Column(name="xp", type="integer", nullable=false)
     */
    private $xp;

    /**
     * @var int
     *
     * @ORM\Column(name="niveau", type="integer", nullable=false)
     */
    private $niveau;

    /**
     * @var int
     *
     * @ORM\Column(name="prix_vente", type="integer", nullable=false)
     */
    private $prixVente;

    /**
     * @var int
     *
     * @ORM\Column(name="dresseurId", type="integer", nullable=false)
     */
    private $dresseurid;


    /**
     * @var boolean
     * @ORM\Column(name="disponibleEntrainement", type="boolean")
     */
    private $disponibleEntrainement;

    /**
     * @ORM\Column(type="integer")
     */
    private $idEspece;


    public function getIdp(): ?int
    {
        return $this->idp;
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

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getXp(): ?int
    {
        return $this->xp;
    }

    public function setXp(int $xp): self
    {
        $this->xp = $xp;

        return $this;
    }

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(int $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getPrixVente(): ?int
    {
        return $this->prixVente;
    }

    public function setPrixVente(int $prixVente): self
    {
        $this->prixVente = $prixVente;

        return $this;
    }

    public function getDresseurid(): ?int
    {
        return $this->dresseurid;
    }

    public function setDresseurid(int $dresseurid): self
    {
        $this->dresseurid = $dresseurid;

        return $this;
    }

    public function getDisponibleEntrainement(): ?bool
    {
        return $this->disponibleEntrainement;
    }

    public function setDisponibleEntrainement(bool $disponibleEntrainement): self
    {
        $this->disponibleEntrainement = $disponibleEntrainement;

        return $this;
    }

    public function getIdEspece(): ?int
    {
        return $this->idEspece;
    }

    public function setIdEspece(int $idEspece): self
    {
        $this->idEspece = $idEspece;

        return $this;
    }


}
