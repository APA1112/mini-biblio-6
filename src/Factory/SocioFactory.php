<?php

namespace App\Factory;

use App\Entity\Socio;
use App\Repository\SocioRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Socio>
 *
 * @method        Socio|Proxy                     create(array|callable $attributes = [])
 * @method static Socio|Proxy                     createOne(array $attributes = [])
 * @method static Socio|Proxy                     find(object|array|mixed $criteria)
 * @method static Socio|Proxy                     findOrCreate(array $attributes)
 * @method static Socio|Proxy                     first(string $sortedField = 'id')
 * @method static Socio|Proxy                     last(string $sortedField = 'id')
 * @method static Socio|Proxy                     random(array $attributes = [])
 * @method static Socio|Proxy                     randomOrCreate(array $attributes = [])
 * @method static SocioRepository|RepositoryProxy repository()
 * @method static Socio[]|Proxy[]                 all()
 * @method static Socio[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Socio[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Socio[]|Proxy[]                 findBy(array $attributes)
 * @method static Socio[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Socio[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class SocioFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'apellidos' => self::faker()->lastName() . ' ' . self::faker()->lastName(),
            'dni' => self::faker()->unique()->dni(),
            'esDocente' => self::faker()->boolean(50),
            'esEstudiante' => self::faker()->boolean(50),
            'nombre' => self::faker()->firstName(),
            'email'=>self::faker()->email(),
            'isAdmin'=>self::faker()->boolean(0),
            'telefono'=>self::faker()->phoneNumber()
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Socio $socio): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Socio::class;
    }
}
