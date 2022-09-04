<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testGettingProductTotalQuantity()
    {
        $product = new Product();

        $this->assertGreaterThanOrEqual(0, $product->getTotalQuantity());
    }

    public function testIsProductOver()
    {
        $product = new Product();

        $this->assertTrue($product->isProductOver());
    }

}