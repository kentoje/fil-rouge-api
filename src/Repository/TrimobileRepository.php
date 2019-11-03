<?php

namespace App\Repository;

use App\Entity\Trimobile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Trimobile|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trimobile|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trimobile[]    findAll()
 * @method Trimobile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrimobileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trimobile::class);
    }

    // /**
    //  * @return Trimobile[] Returns an array of Trimobile objects
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
    public function findOneBySomeField($value): ?Trimobile
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
