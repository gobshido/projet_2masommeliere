<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private $devise = '€';

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prestation", inversedBy="prices", cascade={"persist", "remove"} )
     */
    private $prestation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDesactivated;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Targetprice")
     */
    private $targetprices;

    public function __construct()
    {
        $this->setDevise('€');
        $this->targetprices = new ArrayCollection();
    }

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

    public function getIsDesactivated(): ?bool
    {
        return $this->isDesactivated;
    }

    public function setIsDesactivated(?bool $isDesactivated): self
    {
        $this->isDesactivated = $isDesactivated;

        return $this;
    }

    public function __toString()
    {
        return sprintf('%s', $this->value);
    }

    /**
     * @return Collection|Targetprice[]
     */
    public function getTargetprices(): Collection
    {
        return $this->targetprices;
    }

    public function addTargetprice(Targetprice $targetprice): self
    {
        if (!$this->targetprices->contains($targetprice)) {
            $this->targetprices[] = $targetprice;
        }

        return $this;
    }

    public function removeTargetprice(Targetprice $targetprice): self
    {
        if ($this->targetprices->contains($targetprice)) {
            $this->targetprices->removeElement($targetprice);
        }

        return $this;
    }

}
