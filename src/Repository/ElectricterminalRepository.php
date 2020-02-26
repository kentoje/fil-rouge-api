<?php

namespace App\Repository;

use App\Entity\Electricterminal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Electricterminal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Electricterminal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Electricterminal[]    findAll()
 * @method Electricterminal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElectricterminalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Electricterminal::class);
    }

    public function findAllTerminals(): array
    {
        $results = $this->findAll();

        return $results;
    }

    public function findOneTerminal(int $id): array
    {
        $results = $this->createQueryBuilder('t')
            ->where('t.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

        return $results;
    }
}
