<?php

namespace App\DataFixtures;

use App\Entity\Freelancer;
use App\Factory\FreelancerFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        FreelancerFactory::createMany(30);
    }
}
