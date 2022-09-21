<?php

namespace App\Entity;

use App\Repository\ProductItemRepository;
use Cassandra\Date;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductItemRepository::class)]
class ProductItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $openingDate = null;

    #[ORM\ManyToOne(inversedBy: 'productItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product;

    #[ORM\Column]
    private ?int $quantity = 0;

    #[ORM\ManyToOne(inversedBy: 'productItems')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Shelf $shelf;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $useByDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOpeningDate(): ?\DateTimeInterface
    {
        return $this->openingDate;
    }

    public function setOpeningDate(?\DateTimeInterface $openingDate): self
    {
        $this->openingDate = $openingDate;

        return $this;
    }

    public function getUseByDate(): ?\DateTimeInterface
    {
        return $this->useByDate;
    }

    public function setUseByDate(?\DateTimeInterface $useByDate): self
    {
        $this->useByDate = $useByDate;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getShelf(): ?Shelf
    {
        return $this->shelf;
    }

    public function setShelf(?Shelf $shelf): self
    {
        $this->shelf = $shelf;

        return $this;
    }

    public function isProductItemStillGoodAfterBeingOpened(): bool
    {
        $dateUntilTheProductItemIsStillGood = $this->getOpeningDate()->add($this->getProduct()->getDaysIsGoodAfterOpening());
        if($dateUntilTheProductItemIsStillGood >= $this->getCurrentDate())
        {
            //the product item is still good
            return true;
        };

        return false;
    }

    public function isProductItemExpired(): bool
    {
        if($this->getUseByDate() <= $this->getCurrentDate())
        {
            return true;
        }

        return false;
    }

    // TODO -
    private function getCurrentDate(): \DateTime
    {
        return new \DateTime();
    }
}
