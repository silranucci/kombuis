<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use App\Entity\ProductItem;
use App\Entity\Shelf;
use PHPUnit\Framework\TestCase;

class ProductItemTest extends TestCase
{
    private ProductItem $productItem;

    public function setUp(): void
    {
        $this->productItem = new ProductItem();
    }


    /**
     * @dataProvider ProductItemIsStillGoodAfterBeingOpenedProvider
     */
    public function testProductItemIsStillGoodAfterBeingOpened($currentDate, $openingDate, $daysIsGoodAfterOpening)
    {
        $product = $this->createStub(Product::class);
        $product->method('getDaysIsGoodAfterOpening')
            ->willReturn($daysIsGoodAfterOpening);

        $this->productItem->setProduct($product);

        $this->productItem->setOpeningDate($openingDate);

        $this->assertTrue($this->productItem->isProductItemStillGoodAfterBeingOpened());
    }

    public function ProductItemIsStillGoodAfterBeingOpenedProvider(): array
    {
        $dt = $this->getDateTimeObject();

        return [
            //'item is not good' => [$dt->setDate(2022, 9, 1), $dt->setDate(2022, 9, 11)],
            'item is expired that day ' => [
                $dt->setDate(2022, 9, 11),
                $dt->setDate(2022, 9, 1),
                new \DateInterval('P10D')
            ],
            'item is good' => [
                $dt->setDate(2025, 9, 30),
                $dt->setDate(2022, 9, 11),
                new \DateInterval('P10D')
            ],
        ];
    }

    public function testProductItemIsExpired()
    {
        $this->productItem->setUseByDate($this->getDateTimeObject()->setDate(2020, 12, 31));

        $this->assertTrue($this->productItem->isProductItemExpired());
    }

    /**
     * @dataProvider productItemIsNotExpiredProvider
     */
    public function testProductItemIsNotExpired($useByDate)
    {
        $this->productItem->setUseByDate($useByDate);

        $this->assertFalse($this->productItem->isProductItemExpired());
    }


    public function productItemIsNotExpiredProvider(): array
    {
        $dt = $this->getDateTimeObject();

        return [
            'useByDate equals currentDate' => [$dt],
            'useByDate > currentDate' => [$dt->setDate(2030, 12, 31)],
        ];
    }

    private function getDateTimeObject(): \DateTime
    {
        return new \DateTime();
    }
}

