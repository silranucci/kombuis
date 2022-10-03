<?php

namespace App\Factory;

use App\Entity\Furniture;
use App\Repository\FurnitureRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Furniture>
 *
 * @method static Furniture|Proxy createOne(array $attributes = [])
 * @method static Furniture[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Furniture|Proxy find(object|array|mixed $criteria)
 * @method static Furniture|Proxy findOrCreate(array $attributes)
 * @method static Furniture|Proxy first(string $sortedField = 'id')
 * @method static Furniture|Proxy last(string $sortedField = 'id')
 * @method static Furniture|Proxy random(array $attributes = [])
 * @method static Furniture|Proxy randomOrCreate(array $attributes = [])
 * @method static Furniture[]|Proxy[] all()
 * @method static Furniture[]|Proxy[] findBy(array $attributes)
 * @method static Furniture[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Furniture[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static FurnitureRepository|RepositoryProxy repository()
 * @method Furniture|Proxy create(array|callable $attributes = [])
 */
final class FurnitureFactory extends ModelFactory
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
            'name' => self::faker()->word(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Furniture $cabinet): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Furniture::class;
    }
}
