<?php

namespace App\Repository;

use App\Entity\ElectricterminalDistanceMonument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr;

/**
 * @method ElectricterminalDistanceMonument|null find($id, $lockMode = null, $lockVersion = null)
 * @method ElectricterminalDistanceMonument|null findOneBy(array $criteria, array $orderBy = null)
 * @method ElectricterminalDistanceMonument[]    findAll()
 * @method ElectricterminalDistanceMonument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElectricterminalDistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ElectricterminalDistanceMonument::class);
    }

    public function findAllTerminalsDist(): array
    {
        $results = $this->findAll();

        return $results;
    }

    public function findTerminalDistByIdMonument(int $id_monument): array
    {

        $results = $this->createQueryBuilder('e')
            ->innerJoin(
                'e.idMonuments',
                'm',
                Expr\Join::WITH,
                'm.id = ' . (string) $id_monument
            )
            ->orderBy('e.distanceKm')
            ->getQuery()
            ->getResult();

        return $results;
    }

    public function findTerminalDistByIdMonumentAndDist(int $id_monument, int $dist): array
    {
        $results = $this->createQueryBuilder('e')
            ->innerJoin(
                'e.idMonuments',
                'm',
                Expr\Join::WITH,
                'm.id = ' . $id_monument
            )
            ->where('e.distanceKm <= :dist')
            ->setParameter('dist', (string) $dist)
            ->orderBy('e.distanceKm')
            ->getQuery()
            ->getResult();

        return $results;
    }
}
