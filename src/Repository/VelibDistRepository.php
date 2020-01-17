<?php

namespace App\Repository;

use App\Entity\VelibDistanceMonument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query\Expr;

/**
 * @method VelibDistanceMonument|null find($id, $lockMode = null, $lockVersion = null)
 * @method VelibDistanceMonument|null findOneBy(array $criteria, array $orderBy = null)
 * @method VelibDistanceMonument[]    findAll()
 * @method VelibDistanceMonument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VelibDistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VelibDistanceMonument::class);
    }

    public function findAllVelibDist()
    {
        $response = array();
        $results = $this->findAll();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_km' => $result->getDistanceKm(),
                'id_velib' => $result->getIdVelib()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }

    public function findTrilibDistByIdMonument(int $id_monument)
    {
        $response = array();

        $results = $this->createQueryBuilder('v')
            ->innerJoin(
                'v.idMonuments',
                'm',
                Expr\Join::WITH,
                'm.id = ' . (string) $id_monument
            )
            ->orderBy('v.distanceKm')
            ->getQuery()
            ->getResult();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_km' => $result->getDistanceKm(),
                'id_velib' => $result->getIdVelib()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }

    public function findTrilibDistByIdMonumentAndDist(int $id_monument, $dist)
    {
        $response = array();
        $results = $this->createQueryBuilder('v')
            ->innerJoin(
                'v.idMonuments',
                'm',
                Expr\Join::WITH,
                'm.id = ' . $id_monument
            )
            ->where('v.distanceKm <= :dist')
            ->setParameter('dist', (string) $dist)
            ->orderBy('v.distanceKm')
            ->getQuery()
            ->getResult();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_m' => $result->getDistanceKm(),
                'id_velib' => $result->getIdVelib()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }

    // /**
    //  * @return VelibDistanceMonument[] Returns an array of VelibDistanceMonument objects
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
    public function findOneBySomeField($value): ?VelibDistanceMonument
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