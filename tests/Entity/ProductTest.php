<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use App\Entity\ProductItem;
use App\Enumerations\UnitOfMeasure;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private Product $product;

    public function setUp(): void
    {
        $this->product = new Product ('Prova');
    }

    public function testGettingProductTotalQuantity()
    {
        $productItem1 = $this->createStub(ProductItem::class);
        $productItem1->expects($this->once())
            ->method('getQuantity')
            ->willReturn(100);

        $productItem2 = $this->createStub(ProductItem::class);
        $productItem2->expects($this->once())
            ->method('getQuantity')
            ->willReturn(200);

        $this->product->addProductItem($productItem1);
        $this->product->addProductItem($productItem2);

         $this->assertSame(300, $this->product->getTotalQuantity());
    }

    public function testProductIsUnderSafetyStock()
    {
        $productItem1 = $this->createStub(ProductItem::class);
        $productItem1->expects($this->once())
            ->method('getQuantity')
            ->willReturn(100);

        $this->product->setSafetyStock(150);

        $this->product->addProductItem($productItem1);

        $this->assertTrue($this->product->isProductQuantityUnderSafetyStockLevel());
    }

    /**
     * @dataProvider settingUnitOfMeasureProvider
     * @requires UoM enum
     */
    public function testSettingUnitOfMeasure(string $input)
    {
        $this->product->setUnitOfMeasure(UnitOfMeasure::from($input));

        $this->assertSame($input, $this->product->getUnitOfMeasure());
    }

    public function settingUnitOfMeasureProvider()
    {
        return [
            ["g"],
            ["l"],
            ["kg"],
            ["u"],
            ["ml"],
        ];
    }

}