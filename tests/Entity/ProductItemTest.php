<?php

namespace App\Tests\Entity;

use App\Entity\ProductItem;
use PHPUnit\Framework\TestCase;

class ProductItemTest extends TestCase
{
    public function testProductItemIsStillGoodAfterOpening(): bool
    {
        $productItem = new ProductItem();
        $currentDate = date('d-m-y');

        $productItem->getProduct()->setDaysIsGoodAfterOpening(15);
        $productItem->setOpeningDate(\DateTime::createFromFormat('d-m-y', '01-01-2022'));


        $isProductItemStillGood = $productItem->isItemStillGood(
            $productItem->getProduct()->getDaysIsGoodAfterOpening(),
            $productItem->getOpeningDate(),
            $currentDate,
        );

         $this->assertSame(false, $isProductItemStillGood);
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