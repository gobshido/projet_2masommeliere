<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PressbookRepository")
 */
class Pressbook
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
    private $url_pressbook;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrlPressbook(): ?string
    {
        return $this->url_pressbook;
    }

    public function setUrlPressbook(string $url_pressbook): self
    {
        $this->url_pressbook = $url_pressbook;

        return $this;
    }
}
