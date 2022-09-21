<?php

namespace App\Factory;

use App\Entity\Shelf;
use App\Repository\ShelfRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Shelf>
 *
 * @method static Shelf|Proxy createOne(array $attributes = [])
 * @method static Shelf[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Shelf|Proxy find(object|array|mixed $criteria)
 * @method static Shelf|Proxy findOrCreate(array $attributes)
 * @method static Shelf|Proxy first(string $sortedField = 'id')
 * @method static Shelf|Proxy last(string $sortedField = 'id')
 * @method static Shelf|Proxy random(array $attributes = [])
 * @method static Shelf|Proxy randomOrCreate(array $attributes = [])
 * @method static Shelf[]|Proxy[] all()
 * @method static Shelf[]|Proxy[] findBy(array $attributes)
 * @method static Shelf[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Shelf[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ShelfRepository|RepositoryProxy repository()
 * @method Shelf|Proxy create(array|callable $attributes = [])
 */
final class ShelfFactory extends ModelFactory
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
            'shelfNumber' => self::faker()->numberBetween(0 , 10),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Shelf $shelf): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Shelf::class;
    }
}
