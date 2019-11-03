<?php

namespace App\Repository;

use App\Entity\Velib;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Velib|null find($id, $lockMode = null, $lockVersion = null)
 * @method Velib|null findOneBy(array $criteria, array $orderBy = null)
 * @method Velib[]    findAll()
 * @method Velib[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VelibRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Velib::class);
    }

    // /**
    //  * @return Velib[] Returns an array of Velib objects
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
    public function findOneBySomeField($value): ?Velib
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
