<?php

namespace App\Repository;

use App\Entity\Waste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Waste|null find($id, $lockMode = null, $lockVersion = null)
 * @method Waste|null findOneBy(array $criteria, array $orderBy = null)
 * @method Waste[]    findAll()
 * @method Waste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WasteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Waste::class);
    }

    public function findAllWastes(): array
    {
        $results = $this->findAll();

        return $results;
    }

    public function findOneWaste(int $id): array
    {
        $results = $this->createQueryBuilder('m')
            ->where('m.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

        return $results;
    }
}
