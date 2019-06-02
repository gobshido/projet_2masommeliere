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
    private $value;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $devise;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prestation", inversedBy="prices")
     */
    private $prestation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Targetprice")
     */
    private $targetprice;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDesactivated;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
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

    public function getTargetprice(): ?Targetprice
    {
        return $this->targetprice;
    }

    public function setTargetprice(?Targetprice $targetprice): self
    {
        $this->targetprice = $targetprice;

        return $this;
    }

    public function getIsDesactivated(): ?bool
    {
        return $this->isDesactivated;
    }

    public function setIsDesactivated(?bool $isDesactivated): self
    {
        $this->isDesactivated = $isDesactivated;

        return $this;
    }

}
