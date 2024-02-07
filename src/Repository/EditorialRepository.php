<?php

namespace App\Repository;

use App\Entity\Editorial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Editorial>
 *
 * @method Editorial|null find($id, $lockMode = null, $lockVersion = null)
 * @method Editorial|null findOneBy(array $criteria, array $orderBy = null)
 * @method Editorial[]    findAll()
 * @method Editorial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EditorialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Editorial::class);
    }

    /**
     * @return Editorial[] Returns an array of Editorial objects
     */
    public function findSizeLibrosMenorQue(int $total): array
    {
        return $this
            ->getEntityManager()
            ->createQuery('SELECT e FROM App\Entity\Editorial e WHERE SIZE(e.libros) < :int')
            ->setParameter('int', $total)
            ->getResult();
    }

    /**
     * @return Editorial[] Returns an array of Editorial objects
     */
    public function findOrderByLibrosDesc(): array
    {
        // Si no queremos que se devuelva el total de libros, podemos usar el método SIZE con la cláusula HIDDEN
        // para que no aparezca en los resultados devueltos, así se devuelven entidades puras
        //return $this
        //    ->getEntityManager()
        //    ->createQuery('SELECT e, SIZE(e.libros) AS HIDDEN total FROM App\Entity\Editorial e ORDER BY total DESC')
        //    ->getResult();

        // Devuelve un resultado mixto de una entidad (editorial) y el número de libros (total)
        return $this
            ->getEntityManager()
            ->createQuery('SELECT e AS editorial, SIZE(e.libros) AS total FROM App\Entity\Editorial e ORDER BY total DESC')
            ->getResult();
    }
}
