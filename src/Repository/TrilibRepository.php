<?php

namespace App\Repository;

use App\Entity\Trilib;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method Trilib|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trilib|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trilib[]    findAll()
 * @method Trilib[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrilibRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trilib::class);
    }

    public function findAllTrilibs(): JsonResponse
    {
        $response = array();
        $results = $this->findAll();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'latitude' => $result->getLatitude(),
                'longitude' => $result->getLongitude(),
                'wastetype' => $result->getWastetype(),
                'address' => $result->getAddress(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
            );
        }
        return new JsonResponse($response);
    }

    public function findOneTrilib(int $id): JsonResponse
    {
        $response = array();
        $results = $this->createQueryBuilder('t')
            ->where('t.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any trilib'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response = array(
                'id' => $result->getId(),
                'latitude' => $result->getLatitude(),
                'longitude' => $result->getLongitude(),
                'wastetype' => $result->getWastetype(),
                'address' => $result->getAddress(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
            );
        }
        return new JsonResponse($response);
    }

    public function findMultipleTrilib($tabId): JsonResponse
    {   
        if($tabId === "null"){
            return new JsonResponse([]);
        }

        $response = array();    
        $results = $this->createQueryBuilder('t')
            ->where('t.id in (:tabId)')
            ->setParameter('tabId', explode(",", $tabId))
            ->getQuery()
            ->getResult()
        ;

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any trilib'], Response::HTTP_NOT_FOUND);
        }
        foreach ($results as $result) {
            array_push($response,array(
                'id' => $result->getId(),
                'latitude' => $result->getLatitude(),
                'longitude' => $result->getLongitude(),
                'wastetype' => $result->getWastetype(),
                'address' => $result->getAddress(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
            ));
            
        }
        return new JsonResponse($response);
    }

    public function findMultipleTrilibLimit($tabId,$limit): JsonResponse
    {   
        if($tabId == "null"){
            return new JsonResponse([]);
        }

        $response = array();    
        $results = $this->createQueryBuilder('t')
            ->where('t.id in (:tabId)')
            ->setParameter('tabId', explode(",", $tabId))
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any trilib'], Response::HTTP_NOT_FOUND);
        }
        foreach ($results as $result) {
            array_push($response,array(
                'id' => $result->getId(),
                'latitude' => $result->getLatitude(),
                'longitude' => $result->getLongitude(),
                'wastetype' => $result->getWastetype(),
                'address' => $result->getAddress(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
            ));
            
        }
        return new JsonResponse($response);
    }

    // /**
    //  * @return Trilib[] Returns an array of Trilib objects
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
    public function findOneBySomeField($value): ?Trilib
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
