<?php

namespace App\Repository;

use App\Entity\Velib;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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

    public function findAllVelibs(): JsonResponse
    {
        $response = array();
        $results = $this->findAll();
        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'state' => $result->getState(),
                'freedock' => $result->getFreedock(),
                'creditCard' => $result->getCreditCard(),
                'stationName' => $result->getStationName(),
                'latitude' => $result->getLatitude(),
                'longitude' => $result->getLongitude(),
                'bikeAvailable' => $result->getBikeAvailable(),
            );
        }
        return new JsonResponse($response);
    }

    public function findOneVelib(int $id): JsonResponse
    {
        $results = $this->createQueryBuilder('m')
            ->where('m.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any velib'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response = array(
                'id' => $result->getId(),
                'state' => $result->getState(),
                'freedock' => $result->getFreedock(),
                'creditCard' => $result->getCreditCard(),
                'stationName' => $result->getStationName(),
                'latitude' => $result->getLatitude(),
                'longitude' => $result->getLongitude(),
                'bikeAvailable' => $result->getBikeAvailable(),
            );
        }
        return new JsonResponse($response);
    }

    // /**
    //  * @return Velib[] Returns an array of Velib objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Velib
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
