<?php

namespace App\DataFixtures;

use App\Entity\Furniture;
use App\Entity\Product;
use App\Entity\ProductItem;
use App\Entity\Room;
use App\Entity\Shelf;
use App\Enumerations\UnitOfMeasure;
use App\Factory\ProductFactory;
use App\Factory\ProductItemFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $products = ProductFactory::createMany(50);

        ProductItemFactory::createMany(150, function() use ($products){
            return [
                'product' => $products[array_rand($products)],
            ];
        });

        /*
        $product = new Product();
        $product->setName('Cioccutella');
        $product->setUnitOfMeasure(UnitOfMeasure::GRAM);

        $productItem = new ProductItem();
        $product->addProductItem($productItem);

        $shelf = new Shelf();
        $shelf->addProductItem($productItem);
        $shelf->setShelfNumber(12);

        $furniture = new Furniture();
        $furniture->setName('mobileCucina');
        $furniture->addShelf($shelf);

        $room = new Room();
        $room->setName('cucina');
        $room->addFurniture($furniture);

        $manager->persist($product);
        $manager->persist($productItem);
        $manager->persist($shelf);
        $manager->persist($furniture);
        $manager->persist($room);

        $manager->flush();
        */
    }
}
