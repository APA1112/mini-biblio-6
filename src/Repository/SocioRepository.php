<?php

namespace App\Repository;

use App\Entity\Socio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SocioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Socio::class);
    }
    public function save()
    {
        $this->getEntityManager()->flush();
    }

    public function remove(Socio $socio){
        $this->getEntityManager()->remove($socio);
    }

    public function add(Socio $socio){
        $this->getEntityManager()->persist($socio);
    }
}