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
    private $jour_ouverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heure_ouverture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $heure_fermeture;

    /**
     * @ORM\Column(type="string", length=1020, nullable=true)
     */
    private $presentation;

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
        return $this->jour_ouverture;
    }

    public function setJourOuverture(string $jour_ouverture): self
    {
        $this->jour_ouverture = $jour_ouverture;

        return $this;
    }

    public function getHeureOuverture(): ?\DateTimeInterface
    {
        return $this->heure_ouverture;
    }

    public function setHeureOuverture(?\DateTimeInterface $heure_ouverture): self
    {
        $this->heure_ouverture = $heure_ouverture;

        return $this;
    }

    public function getHeureFermeture(): ?\DateTimeInterface
    {
        return $this->heure_fermeture;
    }

    public function setHeureFermeture(?\DateTimeInterface $heure_fermeture): self
    {
        $this->heure_fermeture = $heure_fermeture;

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
}
