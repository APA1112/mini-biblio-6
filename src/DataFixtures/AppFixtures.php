<?php

namespace App\DataFixtures;

use App\Factory\AutorFactory;
use App\Factory\EditorialFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        AutorFactory::createMany(200);
        EditorialFactory::createMany(100);

        $manager->flush();
    }
}
