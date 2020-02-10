<?php

namespace App\Repository;

use App\Entity\Electricterminal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method Electricterminal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Electricterminal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Electricterminal[]    findAll()
 * @method Electricterminal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElectricterminalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Electricterminal::class);
    }

    public function findAllTerminals(): JsonResponse
    {
        $response = array();
        $results = $this->findAll();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'schedule' => $result->getSchedule(),
                'aftersalesPhone' => $result->getAftersalesPhone(),
                'latitude' => $result->getLatitude(),
                'longitude' => $result->getLongitude(),
                'electricType' => $result->getElectricType(),
                'connectorType' => $result->getConnectorType(),
                'city' => $result->getCity(),
                'address' => $result->getAddress(),
                'zipcode' => $result->getZipcode(),
                'watt' => $result->getWatt(),
                'stationName' => $result->getStationName(),
            );
        }
        return new JsonResponse($response);
    }

    public function findOneTerminal(int $id): JsonResponse
    {
        $results = $this->createQueryBuilder('t')
            ->where('t.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any electric terminal'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response = array(
                'id' => $result->getId(),
                'schedule' => $result->getSchedule(),
                'aftersalesPhone' => $result->getAftersalesPhone(),
                'latitude' => $result->getLatitude(),
                'longitude' => $result->getLongitude(),
                'electricType' => $result->getElectricType(),
                'connectorType' => $result->getConnectorType(),
                'city' => $result->getCity(),
                'address' => $result->getAddress(),
                'zipcode' => $result->getZipcode(),
                'watt' => $result->getWatt(),
                'stationName' => $result->getStationName(),
            );
        }
        return new JsonResponse($response);
    }

    // /**
    //  * @return Electricterminal[] Returns an array of Electricterminal objects
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
    public function findOneBySomeField($value): ?Electricterminal
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
