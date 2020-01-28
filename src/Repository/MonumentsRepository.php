<?php

namespace App\Repository;

use App\Entity\Monuments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method Monuments|null find($id, $lockMode = null, $lockVersion = null)
 * @method Monuments|null findOneBy(array $criteria, array $orderBy = null)
 * @method Monuments[]    findAll()
 * @method Monuments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonumentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Monuments::class);
    }

    public function findAllMonuments()
    {
        $response = array();
        $results = $this->findAll();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'name' => $result->getName(),
                'longitude' => $result->getLongitude(),
                'latitude' => $result->getLatitude(),
                'address' => $result->getAddress(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
            );
        }
        return new JsonResponse($response);
    }

    public function findOneMonument(int $id)
    {
        $results = $this->createQueryBuilder('m')
            ->where('m.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any monument'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response = array(
                'id' => $result->getId(),
                'name' => $result->getName(),
                'longitude' => $result->getLongitude(),
                'latitude' => $result->getLatitude(),
                'address' => $result->getAddress(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
            );
        }
        return new JsonResponse($response);
    }

    public function findAllMonumentsNoJsoned()
    {
        $response = array();
        $results = $this->findAll();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'name' => $result->getName(),
                'longitude' => $result->getLongitude(),
                'latitude' => $result->getLatitude(),
                'address' => $result->getAddress(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
            );
        }
        return $response;
    }

    // /**
    //  * @return Monuments[] Returns an array of Monuments objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Monuments
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
