<?php

namespace App\Repository;

use App\Entity\RecordsWaste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;


/**
 * @method RecordsWaste|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecordsWaste|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecordsWaste[]    findAll()
 * @method RecordsWaste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecordsWasteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecordsWaste::class);
    }

    public function findAllRecordsWastes(): array
    {
        $results = $this->findAll();

        return $results;
    }

    public function findOneRecordWaste(int $id): array
    {
        $results = $this->createQueryBuilder('m')
            ->where('m.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

        return $results;
    }

    public function findAllRecordsWastesByMultiplication(): array
    {
        $results = $this->findAll();

       return $results;
    }

    public function findOneRecordWasteByMultiplication(int $id): array
    {
        $results = $this->createQueryBuilder('m')
            ->where('m.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

       return $results;
    }


    // /**
    //  * @return RecordsWaste[] Returns an array of RecordsWaste objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RecordsWaste
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
