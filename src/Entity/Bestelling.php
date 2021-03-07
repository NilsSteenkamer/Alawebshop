<?php

namespace App\Entity;

use App\Repository\BestellingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BestellingRepository::class)
 */
class Bestelling
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $aantal;

    /**
     * @ORM\ManyToOne(targetEntity=MenuItem::class, inversedBy="bestellings")
     */
    private $menuitem;

    /**
     * @ORM\ManyToOne(targetEntity=Reservering::class, inversedBy="bestellings")
     */
    private $reservering;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $staat_klaar;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAantal(): ?int
    {
        return $this->aantal;
    }

    public function setAantal(int $aantal): self
    {
        $this->aantal = $aantal;

        return $this;
    }

    public function getMenuitem(): ?MenuItem
    {
        return $this->menuitem;
    }

    public function setMenuitem(?MenuItem $menuitem): self
    {
        $this->menuitem = $menuitem;

        return $this;
    }

    public function getReservering(): ?Reservering
    {
        return $this->reservering;
    }

    public function setReservering(?Reservering $reservering): self
    {
        $this->reservering = $reservering;

        return $this;
    }

    public function getStaatKlaar(): ?bool
    {
        return $this->staat_klaar;
    }

    public function setStaatKlaar(?bool $staat_klaar): self
    {
        $this->staat_klaar = $staat_klaar;

        return $this;
    }
    public function __toString()
    {
        return $this->id.'->'.$this->getMenuitem();
    }
}
