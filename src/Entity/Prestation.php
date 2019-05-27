<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private $cible;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=1020)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Module", inversedBy="prestations")
     */
    private $module;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie")
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Prix")
     */
    private $prix;

    public function __construct()
    {
        $this->module = new ArrayCollection();
        $this->prix = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCible(): ?string
    {
        return $this->cible;
    }

    public function setCible(string $cible): self
    {
        $this->cible = $cible;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function __toString() {
        return $this->nom;
    }

    /**
     * @return Collection|Module[]
     */
    public function getModule(): Collection
    {
        return $this->module;
    }

    public function addModule(Module $module): self
    {
        if (!$this->module->contains($module)) {
            $this->module[] = $module;
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        if ($this->module->contains($module)) {
            $this->module->removeElement($module);
        }

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Prix[]
     */
    public function getPrix(): Collection
    {
        return $this->prix;
    }

    public function addPrix(Prix $prix): self
    {
        if (!$this->prix->contains($prix)) {
            $this->prix[] = $prix;
        }

        return $this;
    }

    public function removePrix(Prix $prix): self
    {
        if ($this->prix->contains($prix)) {
            $this->prix->removeElement($prix);
        }

        return $this;
    }
}
