<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactuserRepository")
 */
class Contactuser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jourOuverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heureOuverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heureFermeture;

    /**
     * @ORM\Column(type="string", length=1020, nullable=true)
     */
    private $presentation;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getJourOuverture(): ?string
    {
        return $this->jourOuverture;
    }

    public function setJourOuverture(string $jourOuverture): self
    {
        $this->jourOuverture = $jourOuverture;

        return $this;
    }

    public function getHeureOuverture(): ?\DateTimeInterface
    {
        return $this->heureOuverture;
    }

    public function setHeureOuverture(?\DateTimeInterface $heureOuverture): self
    {
        $this->heureOuverture = $heureOuverture;

        return $this;
    }

    public function getHeureFermeture(): ?\DateTimeInterface
    {
        return $this->heureFermeture;
    }

    public function setHeureFermeture(?\DateTimeInterface $heureFermeture): self
    {
        $this->heureFermeture = $heureFermeture;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(?string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }
}
