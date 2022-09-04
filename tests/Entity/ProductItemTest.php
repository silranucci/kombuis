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
        $product = new Product();
        $shelf = new Shelf();
        $productItem = new ProductItem($dt->setDate(2022, 01, 01), 200, $product, $shelf);

        $productItem->getProduct()->setDaysIsGoodAfterOpening(\DateInterval::createFromDateString('15 day'));
        $productItem->setOpeningDate($dt->setDate(2022,01,30));

         $this->assertSame(false, $productItem->isItemStillGood());
    }

    /*
    public function testIsStillGood(): bool
    {
        $productItem = new ProductItem();
        $currentDate = date('d-m-y');

        $productItem->setUseByDates(\DateTime::createFromFormat('d-m-y', '01-01-22'));

        $this->assertSame(false, $productItem->isStillGood())
    }
    */
}