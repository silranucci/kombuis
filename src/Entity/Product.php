<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $barcode = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $brand = null;

    #[ORM\Column(nullable: true)]
    private ?\DateInterval $daysIsGoodAfterOpening = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductItem::class)]
    private Collection $productItems;

    public function __construct()
    {
        $this->productItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBarcode(): ?int
    {
        return $this->barcode;
    }

    public function setBarcode(int $barcode): self
    {
        $this->barcode = $barcode;

        return $this;
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

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getDaysIsGoodAfterOpening(): ?\DateInterval
    {
        return $this->DaysIsGoodAfterOpening;
    }

    public function setDaysIsGoodAfterOpening(?\DateInterval $DaysIsGoodAfterOpening): self
    {
        $this->DaysIsGoodAfterOpening = $DaysIsGoodAfterOpening;

        return $this;
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
            $productItem->setProduct($this);
        }

        return $this;
    }

    public function removeProductItem(ProductItem $productItem): self
    {
        if ($this->productItems->removeElement($productItem)) {
            // set the owning side to null (unless already changed)
            if ($productItem->getProduct() === $this) {
                $productItem->setProduct(null);
            }
        }

        return $this;
    }

    public function getTotalQuantity(): int
    {
        $productItemsArray = $this->getProductItems()->toArray();
        $totalQuantity = 0;

        foreach ($productItemsArray as $productItem){
            $totalQuantity += $productItem->getQuantity();
        }

        return $totalQuantity;
    }

    public function isProductOver(): bool
    {
        return $this->getTotalQuantity() === 0;
    }
}
