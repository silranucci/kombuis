<?php

namespace App\Factory;

use App\Entity\ProductItem;
use App\Repository\ProductItemRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<ProductItem>
 *
 * @method static ProductItem|Proxy createOne(array $attributes = [])
 * @method static ProductItem[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ProductItem|Proxy find(object|array|mixed $criteria)
 * @method static ProductItem|Proxy findOrCreate(array $attributes)
 * @method static ProductItem|Proxy first(string $sortedField = 'id')
 * @method static ProductItem|Proxy last(string $sortedField = 'id')
 * @method static ProductItem|Proxy random(array $attributes = [])
 * @method static ProductItem|Proxy randomOrCreate(array $attributes = [])
 * @method static ProductItem[]|Proxy[] all()
 * @method static ProductItem[]|Proxy[] findBy(array $attributes)
 * @method static ProductItem[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static ProductItem[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProductItemRepository|RepositoryProxy repository()
 * @method ProductItem|Proxy create(array|callable $attributes = [])
 */
final class ProductItemFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'openingDate' => self::faker()->dateTimeBetween('-1 month'),
            'product' => ProductFactory::new()->create(),
            'quantity' => self::faker()->randomNumber(),
            'shelf' => null,
            'useByDate'=> self::faker()->dateTimeBetween('-1 month', '2 years')
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(ProductItem $productItem): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ProductItem::class;
    }
}
