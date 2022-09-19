<?php

namespace App\Entity;

use App\Repository\FurnitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FurnitureRepository::class)]
class Furniture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;    
    
    #[ORM\Column(length: 100, nullable: false)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'cabinets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Room $room = null;

    #[ORM\OneToMany(mappedBy: 'cabinet', targetEntity: Shelf::class)]
    private Collection $shelves;

    public function __construct()
    {
        $this->shelves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Shelf>
     */
    public function getShelves(): Collection
    {
        return $this->shelves;
    }

    public function addShelf(Shelf $shelf): self
    {
        if (!$this->shelves->contains($shelf)) {
            $this->shelves->add($shelf);
            $shelf->setFurniture($this);
        }

        return $this;
    }

    public function removeShelf(Shelf $shelf): self
    {
        if ($this->shelves->removeElement($shelf)) {
            // set the owning side to null (unless already changed)
            if ($shelf->getFurniture() === $this) {
                $shelf->setFurniture(null);
            }
        }

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }

}
