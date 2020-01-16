<?php

namespace App\Repository;

use App\Entity\TrimobileDistanceMonument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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

    public function findOneTrimobileDist(int $id)
    {
        $results = $this->createQueryBuilder('t')
            ->where('t.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any trimobile distance.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response = array(
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
