<?php

namespace App\Factory;

use App\Entity\Freelancer;
use App\Repository\FreelancerRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Freelancer>
 *
 * @method        Freelancer|Proxy create(array|callable $attributes = [])
 * @method static Freelancer|Proxy createOne(array $attributes = [])
 * @method static Freelancer|Proxy find(object|array|mixed $criteria)
 * @method static Freelancer|Proxy findOrCreate(array $attributes)
 * @method static Freelancer|Proxy first(string $sortedField = 'id')
 * @method static Freelancer|Proxy last(string $sortedField = 'id')
 * @method static Freelancer|Proxy random(array $attributes = [])
 * @method static Freelancer|Proxy randomOrCreate(array $attributes = [])
 * @method static FreelancerRepository|RepositoryProxy repository()
 * @method static Freelancer[]|Proxy[] all()
 * @method static Freelancer[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Freelancer[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Freelancer[]|Proxy[] findBy(array $attributes)
 * @method static Freelancer[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Freelancer[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class FreelancerFactory extends ModelFactory
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
            'name' => self::faker()->text(255),
            'nickname' => self::faker()->unique()->word(),
            'expertises' => ['php', 'symfony', 'doctrine'],
            'created_at' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'updated_at' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime())
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Freelancer $freelancer): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Freelancer::class;
    }
}
