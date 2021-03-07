<?php

namespace App\Entity;

use App\Repository\SubgerechtRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubgerechtRepository::class)
 */
class Subgerecht
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $naam;

    /**
     * @ORM\ManyToOne(targetEntity=Gerecht::class, inversedBy="subgerechts")
     */
    private $gerecht;

    /**
     * @ORM\OneToMany(targetEntity=MenuItem::class, mappedBy="subgerecht")
     */
    private $menuItems;

    public function __construct()
    {
        $this->menuItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getGerecht(): ?Gerecht
    {
        return $this->gerecht;
    }

    public function setGerecht(?Gerecht $gerecht): self
    {
        $this->gerecht = $gerecht;

        return $this;
    }

    /**
     * @return Collection|MenuItem[]
     */
    public function getMenuItems(): Collection
    {
        return $this->menuItems;
    }

    public function addMenuItem(MenuItem $menuItem): self
    {
        if (!$this->menuItems->contains($menuItem)) {
            $this->menuItems[] = $menuItem;
            $menuItem->setSubgerecht($this);
        }

        return $this;
    }

    public function removeMenuItem(MenuItem $menuItem): self
    {
        if ($this->menuItems->removeElement($menuItem)) {
            // set the owning side to null (unless already changed)
            if ($menuItem->getSubgerecht() === $this) {
                $menuItem->setSubgerecht(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getNaam();
    }
}
