<?php

namespace App\Entity;

use App\Repository\TafelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TafelRepository::class)
 */
class Tafel
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
    private $tafel_nr;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_personen;

    /**
     * @ORM\OneToMany(targetEntity=Reservering::class, mappedBy="tafel")
     */
    private $reserverings;

    public function __construct()
    {
        $this->reserverings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTafelNr(): ?int
    {
        return $this->tafel_nr;
    }

    public function setTafelNr(int $tafel_nr): self
    {
        $this->tafel_nr = $tafel_nr;

        return $this;
    }

    public function getMaxPersonen(): ?int
    {
        return $this->max_personen;
    }

    public function setMaxPersonen(int $max_personen): self
    {
        $this->max_personen = $max_personen;

        return $this;
    }

    /**
     * @return Collection|Reservering[]
     */
    public function getReserverings(): Collection
    {
        return $this->reserverings;
    }

    public function addReservering(Reservering $reservering): self
    {
        if (!$this->reserverings->contains($reservering)) {
            $this->reserverings[] = $reservering;
            $reservering->setTafel($this);
        }

        return $this;
    }

    public function removeReservering(Reservering $reservering): self
    {
        if ($this->reserverings->removeElement($reservering)) {
            // set the owning side to null (unless already changed)
            if ($reservering->getTafel() === $this) {
                $reservering->setTafel(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getTafelNr().", max. ".$this->max_personen." personen";
    }
}
