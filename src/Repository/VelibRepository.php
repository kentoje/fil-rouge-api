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

    public function findAllVelibs(): array
    {
        $results = $this->findAll();
        
        return $results;
    }

    public function findOneVelib(int $id): array
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
