<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActualiteRepository")
 */
class Actualite
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
    private $titre_actualite;

    /**
     * @ORM\Column(type="string", length=1020)
     */
    private $description_actualite;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_actualite;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heure_actualite;

    /**
     * @ORM\Column(type="string", length=510, nullable=true)
     */
    private $lieu_actualite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreActualite(): ?string
    {
        return $this->titre_actualite;
    }

    public function setTitreActualite(string $titre_actualite): self
    {
        $this->titre_actualite = $titre_actualite;

        return $this;
    }

    public function getDescriptionActualite(): ?string
    {
        return $this->description_actualite;
    }

    public function setDescriptionActualite(string $description_actualite): self
    {
        $this->description_actualite = $description_actualite;

        return $this;
    }

    public function getDateActualite(): ?\DateTimeInterface
    {
        return $this->date_actualite;
    }

    public function setDateActualite(?\DateTimeInterface $date_actualite): self
    {
        $this->date_actualite = $date_actualite;

        return $this;
    }

    public function getHeureActualite(): ?\DateTimeInterface
    {
        return $this->heure_actualite;
    }

    public function setHeureActualite(?\DateTimeInterface $heure_actualite): self
    {
        $this->heure_actualite = $heure_actualite;

        return $this;
    }

    public function getLieuActualite(): ?string
    {
        return $this->lieu_actualite;
    }

    public function setLieuActualite(?string $lieu_actualite): self
    {
        $this->lieu_actualite = $lieu_actualite;

        return $this;
    }
}
