<?php

namespace App\Repository;

use App\Entity\TrimobileDistanceMonument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr;

/**
 * @method TrimobileDistanceMonument|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrimobileDistanceMonument|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrimobileDistanceMonument[]    findAll()
 * @method TrimobileDistanceMonument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrimobileDistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrimobileDistanceMonument::class);
    }

    public function findAllTrimobileDist(): array
    {
        $results = $this->findAll();

        return $results;
    }

    public function findTrimobileDistByIdMonument(int $id_monument): array
    {
        $results = $this->createQueryBuilder('t')
            ->innerJoin(
                't.idMonuments',
                'm',
                Expr\Join::WITH,
                'm.id = ' . (string) $id_monument
            )
            ->orderBy('t.distanceKm')
            ->getQuery()
            ->getResult();

        return $results;
    }

    public function findTrimobileDistByIdMonumentAndDist(int $id_monument, int $dist): array
    {
        $results = $this->createQueryBuilder('t')
            ->innerJoin(
                't.idMonuments',
                'm',
                Expr\Join::WITH,
                'm.id = ' . $id_monument
            )
            ->where('t.distanceKm <= :dist')
            ->setParameter('dist', (string) $dist)
            ->orderBy('t.distanceKm')
            ->getQuery()
            ->getResult();

        return $results;
    }

    // /**
    //  * @return TrimobileDistanceMonument[] Returns an array of TrimobileDistanceMonument objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TrimobileDistanceMonument
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
