<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;

class ProductItemTest extends TestCase
{
    public function testProductItemIsStillGoodAfterOpening(): bool
    {
        $productItem = new ProductItem();
        $currentDate = date('d-m-y');

        $productItem->getProduct()->setDaysBestAfterOpening(15);
        $productItem->setOpeningDate(\DateTime::createFromFormat('d-m-y', '01-01-2022'));


        $isProductItemStillGood = $productItem->isItemStillGood(
            $productItem->getProduct()->getDaysBestAfterOpening(),
            $productItem->getOpeningDate(),
            $currentDate,
        );

         $this->assertSame(false, $isProductItemStillGood);
    }
}