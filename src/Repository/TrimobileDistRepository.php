<?php

namespace App\Repository;

use App\Entity\TrimobileDistanceMonument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query\Expr;

/**
 * @method TrimobileDistanceMonument|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrimobileDistanceMonument|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrimobileDistanceMonument[]    findAll()
 * @method TrimobileDistanceMonument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrimobileDistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrimobileDistanceMonument::class);
    }

    public function findAllTrimobileDist()
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
                'id_trimobile' => $result->getIdTrimobile()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }

    public function findTrimobileDistByIdMonument(int $id_monument)
    {
        $response = array();

        $results = $this->createQueryBuilder('t')
            ->innerJoin(
                't.idMonuments',
                'm',
                Expr\Join::WITH,
                'm.id = ' . (string) $id_monument
            )
            ->getQuery()
            ->getResult();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_km' => $result->getDistanceKm(),
                'id_trimobile' => $result->getIdTrimobile()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }

    // /**
    //  * @return TrimobileDistanceMonument[] Returns an array of TrimobileDistanceMonument objects
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
    public function findOneBySomeField($value): ?TrimobileDistanceMonument
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
