<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrixRepository")
 */
class Prix
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
    private $prixParticulier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prixEntreprise;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixParticulier(): ?string
    {
        return $this->prixParticulier;
    }

    public function setPrixParticulier(?string $prixParticulier): self
    {
        $this->prixParticulier = $prixParticulier;

        return $this;
    }

    public function getPrixEntreprise(): ?string
    {
        return $this->prixEntreprise;
    }

    public function setPrixEntreprise(?string $prixEntreprise): self
    {
        $this->prixEntreprise = $prixEntreprise;

        return $this;
    }

    public function __toString() {
        return ''.$this->prixParticulier;
    }
}
