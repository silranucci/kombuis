<?php

namespace App\Entity;

use App\Repository\ProductItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductItemRepository::class)]
class ProductItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $ProductIBAN = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductIBAN(): ?int
    {
        return $this->ProductIBAN;
    }

    public function setProductIBAN(int $ProductIBAN): self
    {
        $this->ProductIBAN = $ProductIBAN;

        return $this;
    }
}
