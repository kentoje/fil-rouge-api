<?php

namespace App\Repository;

use App\Entity\ElectricterminalDistanceMonument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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

    public function findAllTerminalsDist():JsonResponse
    {
        $response = array();
        $results = $this->findAll();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_m' => $result->getDistanceKm(),
                'id_electricterminal' => $result->getIdElectricterminal()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }

    public function findTerminalDistByIdMonument(int $id_monument): JsonResponse
    {
        $response = array();

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

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_m' => $result->getDistanceKm(),
                'id_electricterminal' => $result->getIdElectricterminal()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }

    public function findTerminalDistByIdMonumentAndDist(int $id_monument, int $dist): JsonResponse
    {
        $response = array();
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

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_m' => $result->getDistanceKm(),
                'id_electricterminal' => $result->getIdElectricterminal()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }

    public function countTerminalDistByIdMonumentAndDist(int $id_monument, $dist)
    {
        $response = array();
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

        if (!$results) {
            $response[] = array(
                'nb' => 0
            );
            return $response;
        }

            $response[] = array(
                'nb' => count($results)
            );
        return $response;
    }

    public function findTerminalDistByIdMonumentAndDistNoJsoned(int $id_monument, $dist)
    {
        $response = array();
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

        if (!$results) {
            $response = [];
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_m' => $result->getDistanceKm(),
                'id_electricterminal' => $result->getIdElectricterminal()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return $response;
    }



    // /**
    //  * @return ElectricterminalDistanceMonument[] Returns an array of ElectricterminalDistanceMonument objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ElectricterminalDistanceMonument
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
