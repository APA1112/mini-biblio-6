<?php

namespace App\Repository;

use App\Entity\Autor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Autor>
 *
 * @method Autor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Autor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Autor[]    findAll()
 * @method Autor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AutorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Autor::class);
    }

    /**
     * @return Autor[] Returns an array of Autor objects
     */
    public function findOrderByEdad(): array
    {
        return $this
            ->getEntityManager()
            ->createQuery('SELECT a AS autor, SIZE(a.libros) AS total FROM App\Entity\Autor a ORDER BY a.fechaNacimiento DESC')
            ->getResult();
    }
}
