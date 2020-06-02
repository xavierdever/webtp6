<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="integer")
     */
    private $idEspece;

    /**
     * @var DateTime
     * @ORM\Column(name="derniereChasse", type="datetime")
     * @Assert\DateTime()
     */
    private $derniereChasse;


    /**
     * @var DateTime
     * @ORM\Column(name="dernierEntrainement", type="datetime")
     * @Assert\DateTime()
     */
    private $dernierEntrainement;

    /**
     * @return DateTime
     */
    public function getDerniereChasse(): DateTime
    {
        return $this->derniereChasse;
    }

    /**
     * @param DateTime $derniereChasse
     */
    public function setDerniereChasse(DateTime $derniereChasse): void
    {
        $this->derniereChasse = $derniereChasse;
    }

    /**
     * @return DateTime
     */
    public function getDernierEntrainement(): DateTime
    {
        return $this->dernierEntrainement;
    }

    /**
     * @param DateTime $dernierEntrainement
     */
    public function setDernierEntrainement(DateTime $dernierEntrainement): void
    {
        $this->dernierEntrainement = $dernierEntrainement;
    }





    /**
     * @return DateTime
     */
    public function getDateDerniereAction(): DateTime
    {
        return $this->dateDerniereAction;
    }

    /**
     * @param DateTime $dateDerniereAction
     */
    public function setDateDerniereAction(DateTime $dateDerniereAction): void
    {
        $this->dateDerniereAction = $dateDerniereAction;
    }


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
