<?php

namespace App\Entity;

use App\Repository\ShelfRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShelfRepository::class)]
class Shelf
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'shelves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Furniture $furniture = null;

    #[ORM\Column(nullable: false)]
    private ?int $shelfNumber = null;

    #[ORM\OneToMany(mappedBy: 'shelf', targetEntity: ProductItem::class)]
    private Collection $productItems;

    public function __construct()
    {
        $this->productItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFurniture(): ?Furniture
    {
        return $this->furniture;
    }

    public function setFurniture(?Furniture $furniture): self
    {
        $this->furniture = $furniture;

        return $this;
    }

    public function getShelfNumber(): ?int
    {
        return $this->shelfNumber;
    }

    public function setShelfNumber(?int $shelfNumber): void
    {
        $this->shelfNumber = $shelfNumber;
    }

    /**
     * @return Collection<int, ProductItem>
     */
    public function getProductItems(): Collection
    {
        return $this->productItems;
    }

    public function addProductItem(ProductItem $productItem): self
    {
        if (!$this->productItems->contains($productItem)) {
            $this->productItems->add($productItem);
            $productItem->setShelf($this);
        }

        return $this;
    }

    public function removeProductItem(ProductItem $productItem): self
    {
        if ($this->productItems->removeElement($productItem)) {
            // set the owning side to null (unless already changed)
            if ($productItem->getShelf() === $this) {
                $productItem->setShelf(null);
            }
        }

        return $this;
    }
}