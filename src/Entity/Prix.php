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
    private $prix_particulier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prix_entreprise;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixParticulier(): ?string
    {
        return $this->prix_particulier;
    }

    public function setPrixParticulier(?string $prix_particulier): self
    {
        $this->prix_particulier = $prix_particulier;

        return $this;
    }

    public function getPrixEntreprise(): ?string
    {
        return $this->prix_entreprise;
    }

    public function setPrixEntreprise(?string $prix_entreprise): self
    {
        $this->prix_entreprise = $prix_entreprise;

        return $this;
    }
}
