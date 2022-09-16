<?php

namespace App\Factory;

use App\Entity\Cabinet;
use App\Repository\CabinetRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Cabinet>
 *
 * @method static Cabinet|Proxy createOne(array $attributes = [])
 * @method static Cabinet[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Cabinet|Proxy find(object|array|mixed $criteria)
 * @method static Cabinet|Proxy findOrCreate(array $attributes)
 * @method static Cabinet|Proxy first(string $sortedField = 'id')
 * @method static Cabinet|Proxy last(string $sortedField = 'id')
 * @method static Cabinet|Proxy random(array $attributes = [])
 * @method static Cabinet|Proxy randomOrCreate(array $attributes = [])
 * @method static Cabinet[]|Proxy[] all()
 * @method static Cabinet[]|Proxy[] findBy(array $attributes)
 * @method static Cabinet[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Cabinet[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CabinetRepository|RepositoryProxy repository()
 * @method Cabinet|Proxy create(array|callable $attributes = [])
 */
final class CabinetFactory extends ModelFactory
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
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Cabinet $cabinet): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Cabinet::class;
    }
}
