<?php

namespace App\Entity;

use App\Enum\UnitOfMeasure;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::INTEGER, unique: true)]
    private ?int $barCode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $brand = null;

    #[ORM\Column(nullable: true)]
    private ?\DateInterval $daysIsGoodAfterOpening = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductItem::class, cascade: ['persist'], orphanRemoval: true)]
    #[ORM\OrderBy(['useByDate' => 'ASC'])]
    private Collection $productItems;

    #[ORM\Column(nullable: true)]
    private ?int $safetyStock = null;

    #[ORM\Column]
    private ?int $totalQuantity = 0;

    #[ORM\Column(type: 'string', length: 50)]
    private ?string $unitOfMeasure = null;

    public function __construct()
    {
        $this->productItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBarCode(): ?int
    {
        return $this->barCode;
    }

    public function setBarCode(?int $barCode): void
    {
        $this->barCode = $barCode;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): void
    {
        $this->brand = $brand;
    }

    public function getDaysIsGoodAfterOpening(): ?\DateInterval
    {
        return $this->daysIsGoodAfterOpening;
    }

    public function setDaysIsGoodAfterOpening(?\DateInterval $DaysIsGoodAfterOpening): self
    {
        $this->daysIsGoodAfterOpening = $DaysIsGoodAfterOpening;

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




    public function getSafetyStock(): ?int
    {
        return $this->safetyStock;
    }

    public function setSafetyStock(?int $safetyStock): void
    {
        $this->safetyStock = $safetyStock;
    }

    public function isProductQuantityUnderSafetyStockLevel(): bool
    {
        return $this->getTotalQuantity() < $this->safetyStock;
    }


    public function getUnitOfMeasure(): string
    {
        return $this->unitOfMeasure;
    }

    public function getTotalQuantity(): ?int
    {
        return $this->totalQuantity;
    }

    public function setTotalQuantity(?int $totalQuantity): void
    {
        $this->totalQuantity = $totalQuantity;
    }

    public function setUnitOfMeasure(UnitOfMeasure $unitOfMeasure): void
    {
        $this->unitOfMeasure = $unitOfMeasure->value;
    }

}
