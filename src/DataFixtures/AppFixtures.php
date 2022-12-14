<?php

namespace App\DataFixtures;

use App\Factory\FurnitureFactory;
use App\Factory\ProductFactory;
use App\Factory\ProductItemFactory;
use App\Factory\RoomFactory;
use App\Factory\ShelfFactory;
use App\Factory\UserFactory;
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

        UserFactory::createOne([
            'email' => 'che_admin@example.com',
            'firstName' => 'Gioia',
            'roles' => ['USER_ADMIN'],
        ]);
        UserFactory::createOne([
            'email' => 'che_user@example.com',
            'firstName' => 'Tauro',
            'roles' => ['USER_ADMIN'],
        ]);
        UserFactory::createMany(10);
    }
}
