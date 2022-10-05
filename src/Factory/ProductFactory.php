<?php

namespace App\Factory;

use App\Entity\Product;
use App\Enumerations\UnitOfMeasure;
use App\Repository\ProductRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Product>
 *
 * @method static Product|Proxy createOne(array $attributes = [])
 * @method static Product[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Product|Proxy find(object|array|mixed $criteria)
 * @method static Product|Proxy findOrCreate(array $attributes)
 * @method static Product|Proxy first(string $sortedField = 'id')
 * @method static Product|Proxy last(string $sortedField = 'id')
 * @method static Product|Proxy random(array $attributes = [])
 * @method static Product|Proxy randomOrCreate(array $attributes = [])
 * @method static Product[]|Proxy[] all()
 * @method static Product[]|Proxy[] findBy(array $attributes)
 * @method static Product[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Product[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProductRepository|RepositoryProxy repository()
 * @method Product|Proxy create(array|callable $attributes = [])
 */
final class ProductFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    public function setKilogram(): self
    {
        return $this->addState(['unitOfMeasure' => UnitOfMeasure::KILOGRAM]);
    }

    public function setMillilitre(): self
    {
        return $this->addState(['unitOfMeasure' => UnitOfMeasure::MILLILITRE]);
    }

    public function setUnit(): self
    {
        return $this->addState(['unitOfMeasure' => UnitOfMeasure::UNITS]);
    }


    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'barcode' => self::faker()->ean8(),
            'brand' => self::faker()->word(),
            'daysIsGoodAfterOpening' => self::faker()->boolean(30) ? new \DateInterval('P10D') : null,
            'name' => self::faker()->word(),
            'safetyStock' => self::faker()->numberBetween(0, 3),
            'unitOfMeasure' => UnitOfMeasure::GRAM,
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Product $product): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Product::class;
    }
}
