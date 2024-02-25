<?php

namespace App\DataFixtures;

use App\Entity\Socio;
use App\Factory\AutorFactory;
use App\Factory\EditorialFactory;
use App\Factory\LibroFactory;
use App\Factory\SocioFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        AutorFactory::createMany(200);
        SocioFactory::createMany(20);
        EditorialFactory::createMany(100);
        LibroFactory::createMany(50, function (){
            return [
                'editorial'=>EditorialFactory::random(),
                'socio'=>LibroFactory::faker()->boolean(25)?SocioFactory::random():null,
                'autores'=>AutorFactory::randomRange(1,3)
            ];
        });

        $manager->flush();
    }
}
