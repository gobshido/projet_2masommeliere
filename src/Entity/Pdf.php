<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PdfRepository")
 */
class Pdf
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
    private $pathrelatif;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pathabsolu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPathrelatif(): ?string
    {
        return $this->pathrelatif;
    }

    public function setPathrelatif(string $pathrelatif): self
    {
        $this->pathrelatif = $pathrelatif;

        return $this;
    }

    public function getPathabsolu(): ?string
    {
        return $this->pathabsolu;
    }

    public function setPathabsolu(string $pathabsolu): self
    {
        $this->pathabsolu = $pathabsolu;

        return $this;
    }
}
