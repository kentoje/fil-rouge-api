<?php

namespace App\Repository;

use App\Entity\Trimobile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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

    public function findAllTrimobiles(): JsonResponse
    {
        $response = array();
        $results = $this->findAll();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
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
        return new JsonResponse($response);
    }

    public function findOneTrimobile(int $id): JsonResponse
    {
        $results = $this->createQueryBuilder('m')
            ->where('m.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any tri mobile'], Response::HTTP_NOT_FOUND);
        }

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
        return new JsonResponse($response);
    }

    public function findMultipleTrimobile($tabId): JsonResponse
    {
        if($tabId === "null"){
            return new JsonResponse([]);
        }
        $response = array();    
        $results = $this->createQueryBuilder('m')
            ->where('m.id in (:id)')
            ->setParameter('id', explode(",",$tabId))
            ->getQuery()
            ->getResult()
        ;

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any tri mobile'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            array_push($response,array(
                'id' => $result->getId(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
                'address' => $result->getAddress(),
                'schedule' => $result->getSchedule(),
                'longitude' => $result->getLongitude(),
                'latitude' => $result->getLatitude(),
                'timeRange' => $result->getTimeRange(),
                'addressSupplement' => $result->getAddressSupplement(),
            ));
        }
        return new JsonResponse($response);
    }

    public function findMultipleTrimobilewithLimit($tabId,$limit): JsonResponse
    {

        if($tabId === "null"){
            return new JsonResponse([]);
        }

        $response = array();    
        $results = $this->createQueryBuilder('m')
            ->where('m.id in (:id)')
            ->setParameter('id', explode(",",$tabId))
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any tri mobile'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            array_push($response,array(
                'id' => $result->getId(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
                'address' => $result->getAddress(),
                'schedule' => $result->getSchedule(),
                'longitude' => $result->getLongitude(),
                'latitude' => $result->getLatitude(),
                'timeRange' => $result->getTimeRange(),
                'addressSupplement' => $result->getAddressSupplement(),
            ));
        }
        return new JsonResponse($response);
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
