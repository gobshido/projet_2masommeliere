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
     * @ORM\Column(type="string", length=255)
     */
    private $value;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $devise;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prestation", inversedBy="prices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $prestation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PriceType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typePrix;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getDevise(): ?string
    {
        return $this->devise;
    }

    public function setDevise(?string $devise): self
    {
        $this->devise = $devise;

        return $this;
    }

    public function getPrestation(): ?Prestation
    {
        return $this->prestation;
    }

    public function setPrestation(?Prestation $prestation): self
    {
        $this->prestation = $prestation;

        return $this;
    }

    public function getTypePrix(): ?PriceType
    {
        return $this->typePrix;
    }

    public function setTypePrix(?PriceType $typePrix): self
    {
        $this->typePrix = $typePrix;

        return $this;
    }

    public function __toString() {
        return ''.$this->value;
    }
}
