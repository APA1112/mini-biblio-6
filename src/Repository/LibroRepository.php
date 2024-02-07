<?php

namespace App\Repository;

use App\Entity\Libro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Libro>
 *
 * @method Libro|null find($id, $lockMode = null, $lockVersion = null)
 * @method Libro|null findOneBy(array $criteria, array $orderBy = null)
 * @method Libro[]    findAll()
 * @method Libro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LibroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Libro::class);
    }

    /**
     * @return Libro[] Returns an array of Libro objects
     */
    public function findOrderByTitulo(): array
    {
        // Usando métodos del repositorio
        //return $this->findBy([], ['titulo' => 'ASC']);

        // Usando DQL
        return $this
            ->getEntityManager()
            ->createQuery('SELECT l FROM App\Entity\Libro l ORDER BY l.titulo ASC')
            ->getResult();
    }

    /**
     * @return Libro[] Returns an array of Libro objects
     */
    public function findOrderByAnioPublicacionDesc(): array
    {
        // Usando métodos del repositorio
        //return $this->findBy([], ['anioPublicacion' => 'DESC']);

        // Usando DQL
        return $this
            ->getEntityManager()
            ->createQuery('SELECT l FROM App\Entity\Libro l ORDER BY l.anioPublicacion DESC')
            ->getResult();
    }
}
