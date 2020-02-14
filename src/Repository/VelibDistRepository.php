<?php

namespace App\Repository;

use App\Entity\VelibDistanceMonument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr;

/**
 * @method VelibDistanceMonument|null find($id, $lockMode = null, $lockVersion = null)
 * @method VelibDistanceMonument|null findOneBy(array $criteria, array $orderBy = null)
 * @method VelibDistanceMonument[]    findAll()
 * @method VelibDistanceMonument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VelibDistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VelibDistanceMonument::class);
    }

    public function findAllVelibDist(): array
    {
        $results = $this->findAll();

        return $results;
    }

    public function findTrilibDistByIdMonument(int $id_monument): array
    {
        $results = $this->createQueryBuilder('v')
            ->innerJoin(
                'v.idMonuments',
                'm',
                Expr\Join::WITH,
                'm.id = ' . (string) $id_monument
            )
            ->orderBy('v.distanceKm')
            ->getQuery()
            ->getResult();

       return $results;
    }

    public function findTrilibDistByIdMonumentAndDist(int $id_monument, int $dist): array
    {
        $results = $this->createQueryBuilder('v')
            ->innerJoin(
                'v.idMonuments',
                'm',
                Expr\Join::WITH,
                'm.id = ' . $id_monument
            )
            ->where('v.distanceKm <= :dist')
            ->setParameter('dist', (string) $dist)
            ->orderBy('v.distanceKm')
            ->getQuery()
            ->getResult();

        return $results;
    }

    // /**
    //  * @return VelibDistanceMonument[] Returns an array of VelibDistanceMonument objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VelibDistanceMonument
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
