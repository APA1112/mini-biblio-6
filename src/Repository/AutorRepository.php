<?php

namespace App\Repository;

use App\Entity\Autor;
use App\Entity\Libro;
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

    /**
     * @return Autor[] Returns an array of Autor objects
     */
    public function findByLibroOrderByApellidosNombre(Libro $libro): array
    {
        // Forma alternativa, menos eficiente
        //return $this
        //    ->getEntityManager()
        //    ->createQuery('SELECT a FROM App\Entity\Autor a JOIN a.libros l WHERE l = :libro ORDER BY a.apellidos, a.nombre')
        //    ->setParameter('libro', $libro)
        //    ->getResult();
        return $this
            ->getEntityManager()
            ->createQuery('SELECT a FROM App\Entity\Autor a WHERE :libro MEMBER OF a.libros ORDER BY a.apellidos, a.nombre')
            ->setParameter('libro', $libro)
            ->getResult();
    }
}
