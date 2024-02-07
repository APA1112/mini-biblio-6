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

    /**
     * @return Libro[] Returns an array of Libro objects
     */
    public function findByPalabraTitulo(string $palabra): array
    {
        return $this
            ->getEntityManager()
            ->createQuery('SELECT l FROM App\Entity\Libro l WHERE l.titulo LIKE :texto')
            ->setParameter('texto', '%' . $palabra . '%')
            ->getResult();
    }

    /**
     * @return Libro[] Returns an array of Libro objects
     */
    public function findBySinLetraEditorial(string $letra): array
    {
        return $this
            ->getEntityManager()
            ->createQuery('SELECT l FROM App\Entity\Libro l JOIN l.editorial e WHERE e.nombre NOT LIKE :texto')
            ->setParameter('texto', '%' . $letra . '%')
            ->getResult();
    }

    /**
     * @return Libro[] Returns an array of Libro objects
     */
    public function findUnAutor(): array
    {
        return $this
            ->getEntityManager()
            ->createQuery('SELECT l FROM App\Entity\Libro l WHERE SIZE(l.autores) = 1')
            ->getResult();
    }

    /**
     * @return Libro[] Returns an array of Libro objects
     */
    public function findOrderByTituloOptimizado(): array
    {
        // Es la misma consulta del apartado 1, pero optimizada
        //
        // Hacemos un FETCH JOIN para traer los autores y la editorial
        // Usamos LEFT JOIN con editorial para que no elimine los libros que no tienen editorial
        //
        // Con esto conseguimos que se haga una sola consulta a la base de datos
        return $this
            ->getEntityManager()
            ->createQuery('SELECT l, a, e FROM App\Entity\Libro l JOIN l.autores a LEFT JOIN l.editorial e ORDER BY l.titulo ASC')
            ->getResult();
    }
}
