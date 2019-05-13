<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModuleRepository")
 */
class Module
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
    private $nom_module;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $duree_module;

    /**
     * @ORM\Column(type="string", length=2040, nullable=true)
     */
    private $description_module;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomModule(): ?string
    {
        return $this->nom_module;
    }

    public function setNomModule(string $nom_module): self
    {
        $this->nom_module = $nom_module;

        return $this;
    }

    public function getDureeModule(): ?\DateTimeInterface
    {
        return $this->duree_module;
    }

    public function setDureeModule(?\DateTimeInterface $duree_module): self
    {
        $this->duree_module = $duree_module;

        return $this;
    }

    public function getDescriptionModule(): ?string
    {
        return $this->description_module;
    }

    public function setDescriptionModule(?string $description_module): self
    {
        $this->description_module = $description_module;

        return $this;
    }
}
