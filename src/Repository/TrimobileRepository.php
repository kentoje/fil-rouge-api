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

    public function findAllTrimobiles(): array
    {
        $results = $this->findAll();

        return $results;
    }

    public function findOneTrimobile(int $id): array
    {
        $results = $this->createQueryBuilder('m')
            ->where('m.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

        return $results;
    }

    public function findMultipleTrimobile($tabId): array
    {
   
        $results = $this->createQueryBuilder('m')
            ->where('m.id in (:id)')
            ->setParameter('id', explode(",",$tabId))
            ->getQuery()
            ->getResult()
        ;

        return $results;
    }

    public function findMultipleTrimobilewithLimit($tabId,$limit): array
    {

        $results = $this->createQueryBuilder('m')
            ->where('m.id in (:id)')
            ->setParameter('id', explode(",",$tabId))
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;

        return $results;
    }
}
