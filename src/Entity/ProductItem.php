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
    // #[ORM\GeneratedValue] SE INSERITO "Single id is not allowed on composite primary key in entity"
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $openingDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $useByDates = null;

    //#[ORM\Column(type: Types::BOOLEAN, nullable: false)]
    //private ?bool $isStillGood = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'productItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'productItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Shelf $shelf = null;


    public function __construct(\DateTime $useByDates, int $quantity, Product $product, Shelf $shelf)
    {
        $this->useByDates = $useByDates;
        $this->quantity = $quantity;
        $this->product = $product;
        $this->shelf = $shelf;
    }


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

    public function getUseByDates(): ?\DateTimeInterface
    {
        return $this->useByDates;
    }

    public function setUseByDates(?\DateTimeInterface $useByDates): self
    {
        $this->useByDates = $useByDates;

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

    public function isItemStillGood(): bool
    {
        $todayDate = new \DateTime();
        if($this->openingDate->diff(new \DateTime()) <  $todayDate->add($this->getProduct()->getDaysIsGoodAfterOpening()))
        {
            return true;
        };

        return false;
    }

}
