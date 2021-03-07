<?php

namespace App\Entity;

use App\Repository\ReserveringRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReserveringRepository::class)
 */
class Reservering
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datum_tijd;

    /**
     * @ORM\Column(type="integer")
     */
    private $aantal_personen;

    /**
     * @ORM\ManyToOne(targetEntity=Klant::class, inversedBy="reserverings")
     */
    private $klant;

    /**
     * @ORM\ManyToOne(targetEntity=Tafel::class, inversedBy="reserverings")
     */
    private $tafel;

    /**
     * @ORM\OneToMany(targetEntity=Bestelling::class, mappedBy="reservering")
     */
    private $bestellings;

    /**
     * @ORM\OneToMany(targetEntity=Bon::class, mappedBy="reservering")
     */
    private $bons;

    public function __construct()
    {
        $this->bestellings = new ArrayCollection();
        $this->bons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatumTijd(): ?\DateTimeInterface
    {
        return $this->datum_tijd;
    }

    public function setDatumTijd(\DateTimeInterface $datum_tijd): self
    {
        $this->datum_tijd = $datum_tijd;

        return $this;
    }

    public function getAantalPersonen(): ?int
    {
        return $this->aantal_personen;
    }

    public function setAantalPersonen(int $aantal_personen): self
    {
        $this->aantal_personen = $aantal_personen;

        return $this;
    }

    public function getKlant(): ?Klant
    {
        return $this->klant;
    }

    public function setKlant(?Klant $klant): self
    {
        $this->klant = $klant;

        return $this;
    }

    public function getTafel(): ?Tafel
    {
        return $this->tafel;
    }

    public function setTafel(?Tafel $tafel): self
    {
        $this->tafel = $tafel;

        return $this;
    }

    /**
     * @return Collection|Bestelling[]
     */
    public function getBestellings(): Collection
    {
        return $this->bestellings;
    }

    public function addBestelling(Bestelling $bestelling): self
    {
        if (!$this->bestellings->contains($bestelling)) {
            $this->bestellings[] = $bestelling;
            $bestelling->setReservering($this);
        }

        return $this;
    }

    public function removeBestelling(Bestelling $bestelling): self
    {
        if ($this->bestellings->removeElement($bestelling)) {
            // set the owning side to null (unless already changed)
            if ($bestelling->getReservering() === $this) {
                $bestelling->setReservering(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bon[]
     */
    public function getBons(): Collection
    {
        return $this->bons;
    }

    public function addBon(Bon $bon): self
    {
        if (!$this->bons->contains($bon)) {
            $this->bons[] = $bon;
            $bon->setReservering($this);
        }

        return $this;
    }

    public function removeBon(Bon $bon): self
    {
        if ($this->bons->removeElement($bon)) {
            // set the owning side to null (unless already changed)
            if ($bon->getReservering() === $this) {
                $bon->setReservering(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getId().", ".$this->getKlant();
    }
}
