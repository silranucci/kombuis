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
    private ?int $Barcode = null;

    #[ORM\Column(length: 50)]
    private ?string $Name = null;

    #[ORM\Column(length: 50)]
    private ?string $Brand = null;

    #[ORM\Column]
    private ?int $TotalQuantity = null;

    #[ORM\Column(nullable: true)]
    private ?int $DaysIsGoodAfterOpening = null;

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
        return $this->Barcode;
    }

    public function setBarcode(int $Barcode): self
    {
        $this->Barcode = $Barcode;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->Brand;
    }

    public function setBrand(string $Brand): self
    {
        $this->Brand = $Brand;

        return $this;
    }

    public function getTotalQuantity(): ?int
    {
        return $this->TotalQuantity;
    }

    public function setTotalQuantity(int $TotalQuantity): self
    {
        $this->TotalQuantity = $TotalQuantity;

        return $this;
    }

    public function getDaysIsGoodAfterOpening(): ?int
    {
        return $this->DaysIsGoodAfterOpening;
    }

    public function setDaysIsGoodAfterOpening(?int $DaysIsGoodAfterOpening): self
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
}
