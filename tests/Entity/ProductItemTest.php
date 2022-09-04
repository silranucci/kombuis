<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use App\Entity\ProductItem;
use App\Entity\Shelf;
use Cassandra\Date;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\Flash\AutoExpireFlashBag;

class ProductItemTest extends TestCase
{
    public function testProductItemIsStillGoodAfterOpening()
    {
        $dt = new \DateTime();
        $productItem = new ProductItem($dt->setDate(2022, 01, 01), 200, new Product(), new Shelf());

        $productItem->getProduct()->setDaysIsGoodAfterOpening(\DateInterval::createFromDateString('15 day'));
        $productItem->setOpeningDate($dt->setDate(2022, 01, 30));

        $this->assertFalse($productItem->isItemStillGood());
    }

    public function testIsItemExpired()
    {
        $dt = new \DateTime();
        $productItem = new ProductItem($dt->setDate(2022, 01, 01), 200, new Product(), new Shelf());

        $this->assertTrue($productItem->isItemExpired());
    }

    public function testIsItemOver()
    {
        $productItem = new ProductItem(new \DateTime(), 0, new Product(), new Shelf());

        $this->assertTrue($productItem->isItemOver());

        $productItem->setQuantity(200);

        $this->assertFalse($productItem->isItemOver());
    }


}