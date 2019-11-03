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

    public function findAllTrimobiles()
    {
        $response = array();
        foreach ($this->findAll() as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
                'address' => $result->getAddress(),
                'schedule' => $result->getSchedule(),
                'longitude' => $result->getLongitude(),
                'latitude' => $result->getLatitude(),
                'timeRange' => $result->getTimeRange(),
                'addressSupplement' => $result->getAddressSupplement(),
            );
        }
        return $response;
    }

    public function findOneTrimobile(int $id)
    {
        $results = $this->createQueryBuilder('m')
            ->where('m.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

        foreach ($results as $result) {
            $response = array(
                'id' => $result->getId(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
                'address' => $result->getAddress(),
                'schedule' => $result->getSchedule(),
                'longitude' => $result->getLongitude(),
                'latitude' => $result->getLatitude(),
                'timeRange' => $result->getTimeRange(),
                'addressSupplement' => $result->getAddressSupplement(),
            );
        }
        return $response;
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
