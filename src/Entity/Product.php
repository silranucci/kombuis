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
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $brand = null;

    #[ORM\Column(nullable: true)]
    private ?\DateInterval $daysIsGoodAfterOpening = null;

    #[ORM\Column]
    private ?int $totalQuantity = null;

    #[ORM\Column(length: 50)]
    private ?string $unitOfMeasure = null;

    #[ORM\Column(nullable: true)]
    private ?int $safetyStock = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductItem::class)]
    private Collection $productItems;


    public function __construct(string $name)
    {
        $this->productItems = new ArrayCollection();
        $this->name = $name;
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
        $totalQuantity = 0;

        foreach ($this->productItems as $productItem){
            $totalQuantity += $productItem->getQuantity();
        }

        return $totalQuantity;
    }

    public function setSafetyStock(?int $safetyStock): void
    {
        $this->safetyStock = $safetyStock;
    }



}
