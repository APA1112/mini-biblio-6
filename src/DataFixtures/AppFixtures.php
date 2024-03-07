<?php

namespace App\DataFixtures;

use App\Entity\Socio;
use App\Factory\AutorFactory;
use App\Factory\EditorialFactory;
use App\Factory\LibroFactory;
use App\Factory\SocioFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        AutorFactory::createMany(200);
        SocioFactory::createOne([
            'email'=>'admin@biblio.local',
            'password'=>$this->passwordHasher->hashPassword(new Socio(), 'admin'),
            'isAdmin'=>true
        ]);
        SocioFactory::createOne([
            'email'=>'docente@biblio.local',
            'password'=>$this->passwordHasher->hashPassword(new Socio(), 'docente'),
            'esDocente'=>true,
            'esEstudiante'=>false
        ]);
        SocioFactory::createOne([
            'email'=>'estudiante@biblio.local',
            'password'=>$this->passwordHasher->hashPassword(new Socio(), 'estudiante'),
            'esDocente'=>false,
            'esEstudiante'=>true,
        ]);
        $password = $this->passwordHasher->hashPassword(new Socio(), 'admin');
        SocioFactory::createMany(20, function () use ($password){
            $docente = SocioFactory::faker()->boolean(10);
            return [
                'password'=>$password,
                'esDocente'=> $docente,
                'esEstudiante'=>!$docente
            ];
        });
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
