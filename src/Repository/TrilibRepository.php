<?php

namespace App\Repository;

use App\Entity\Trilib;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Trilib|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trilib|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trilib[]    findAll()
 * @method Trilib[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrilibRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trilib::class);
    }

    // /**
    //  * @return Trilib[] Returns an array of Trilib objects
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
    public function findOneBySomeField($value): ?Trilib
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
