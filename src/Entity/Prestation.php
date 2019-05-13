<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrestationRepository")
 */
class Prestation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cible_prestation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_prestation;

    /**
     * @ORM\Column(type="string", length=1020)
     */
    private $description_prestation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCiblePrestation(): ?string
    {
        return $this->cible_prestation;
    }

    public function setCiblePrestation(string $cible_prestation): self
    {
        $this->cible_prestation = $cible_prestation;

        return $this;
    }

    public function getNomPrestation(): ?string
    {
        return $this->nom_prestation;
    }

    public function setNomPrestation(string $nom_prestation): self
    {
        $this->nom_prestation = $nom_prestation;

        return $this;
    }

    public function getDescriptionPrestation(): ?string
    {
        return $this->description_prestation;
    }

    public function setDescriptionPrestation(string $description_prestation): self
    {
        $this->description_prestation = $description_prestation;

        return $this;
    }
}
