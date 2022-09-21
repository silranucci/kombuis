<?php

namespace App\DataFixtures;

use App\Entity\Furniture;
use App\Entity\Product;
use App\Entity\ProductItem;
use App\Entity\Room;
use App\Entity\Shelf;
use App\Enumerations\UnitOfMeasure;
use App\Factory\FurnitureFactory;
use App\Factory\ProductFactory;
use App\Factory\ProductItemFactory;
use App\Factory\RoomFactory;
use App\Factory\ShelfFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $rooms = RoomFactory::createMany(5);

        $furnitures = FurnitureFactory::createMany(3, function() use ($rooms){
            return [
                'room' => $rooms[array_rand($rooms)],
            ];
        });

        $shelves = ShelfFactory::createMany(10, function() use ($furnitures){
            return [
                'furniture' => $furnitures[array_rand($furnitures)],
            ];
        });


        $products = ProductFactory::createMany(50);

        ProductItemFactory::createMany(150, function() use ($products, $shelves){
            return [
                'product' => $products[array_rand($products)],
                'shelf' => $shelves[array_rand($shelves)],
            ];
        });
    }
}
