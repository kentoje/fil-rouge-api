<?php

namespace App\Repository;

use App\Entity\TrilibDistanceMonument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr;

/**
 * @method TrilibDistanceMonument|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrilibDistanceMonument|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrilibDistanceMonument[]    findAll()
 * @method TrilibDistanceMonument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrilibDistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrilibDistanceMonument::class);
    }

    public function findAllTrilibDist(): array
    {
        $results = $this->findAll();

        return $results;
    }

    public function findTrilibDistByIdMonument(int $id_monument): array
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

    public function findTrilibDistByIdMonumentAndDist(int $id_monument, int $dist): array
    {
        $results = $this->createQueryBuilder('t')
            ->innerJoin(
                't.idMonuments',
                'm',
                Expr\Join::WITH,
                'm.id = ' . (string) $id_monument
            )
            ->where('t.distanceKm <= :dist')
            ->setParameter('dist', $dist)
            ->orderBy('t.distanceKm')
            ->getQuery()
            ->getResult();

        return $results;
    }
}
