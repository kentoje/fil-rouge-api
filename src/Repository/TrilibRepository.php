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

    public function findAllTrilibs(): array
    {
        $results = $this->findAll();

        return $results;
    }

    public function findOneTrilib(int $id): array
    {
        $results = $this->createQueryBuilder('t')
            ->where('t.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

        return $results;
    }

    public function findMultipleTrilib($tabId): array
    {   

  
        $results = $this->createQueryBuilder('t')
            ->where('t.id in (:tabId)')
            ->setParameter('tabId', explode(",", $tabId))
            ->getQuery()
            ->getResult()
        ;

        return $results;
    }

    public function findMultipleTrilibLimit($tabId,$limit): array
    {   
        
        $results = $this->createQueryBuilder('t')
            ->where('t.id in (:tabId)')
            ->setParameter('tabId', explode(",", $tabId))
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;

        return $results;
    }
}
