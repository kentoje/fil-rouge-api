<?php

namespace App\Repository;

use App\Entity\RecordsWaste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method RecordsWaste|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecordsWaste|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecordsWaste[]    findAll()
 * @method RecordsWaste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecordsWasteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecordsWaste::class);
    }

    public function findAllRecordsWastes(): JsonResponse
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
                'tons' => $result->getTons(),
            );
        }

        return new JsonResponse($response);
    }

    public function findOneRecordWaste(int $id): JsonResponse
    {
        $response = array();
        $results = $this->createQueryBuilder('m')
            ->where('m.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any waste'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response = array(
                'id' => $result->getId(),
                'name' => $result->getName(),
                'tons' => $result->getTons(),
            );
        }
        return new JsonResponse($response);
    }

    public function findAllRecordsWastesByMultiplication(int $numberDay, string $foreignerPeople): JsonResponse
    {
        $response = array();
        $results = $this->findAll();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        if ($foreignerPeople === 'true'){
            foreach ($results as $result) {
                $response[] = array(
                    'id' => $result->getId(),
                    'name' => $result->getName(),
                    'tons' => $result->getTons() * ($numberDay * 1.23),
                );
            }
        } else if ($foreignerPeople === 'false') {
            foreach ($results as $result) {
                $response[] = array(
                    'id' => $result->getId(),
                    'name' => $result->getName(),
                    'tons' => $result->getTons() * $numberDay,
                );
            }
        }

        return new JsonResponse($response);
    }

    public function findOneRecordWasteByMultiplication(int $numberDay, string $foreignerPeople, int $id): JsonResponse
    {
        $response = array();
        $results = $this->createQueryBuilder('m')
            ->where('m.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any waste'], Response::HTTP_NOT_FOUND);
        }

        if($foreignerPeople === "true") {
            foreach ($results as $result) {
                $response = array(
                    'id' => $result->getId(),
                    'name' => $result->getName(),
                    'tons' => $result->getTons() * $numberDay * 1.23,
                );
            }
        } else if ($foreignerPeople === "false") {
            foreach ($results as $result) {
                $response = array(
                    'id' => $result->getId(),
                    'name' => $result->getName(),
                    'tons' => $result->getTons() * $numberDay,
                );
            }
        }

        return new JsonResponse($response);
    }


    // /**
    //  * @return RecordsWaste[] Returns an array of RecordsWaste objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RecordsWaste
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
