<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findAllUsers(): JsonResponse
    {
        $response = array();

        $conn = $this->getEntityManager()->getConnection();
        
        $sqlQueries = 'SELECT user.id, user.first_name, user.last_name, user.email, user.password, user.score, country.name as country FROM user INNER JOIN country ON user.id_country = country.id;';

        $stmt = $conn->prepare($sqlQueries);
        $stmt->execute();
        $results = $stmt->fetchAll();

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any user'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result['id'],
                'first_name' => $result['first_name'],
                'last_name' => $result['last_name'],
                'email' => $result['email'],
                'password' => $result['password'],
                'score' => $result['score'],
                'country' => $result['country'],
            );
        }
        return new JsonResponse($response);
    }

    public function findOneUser(int $id): JsonResponse
    {
        $response = array();

        $conn = $this->getEntityManager()->getConnection();
        
        $sqlQueries = 'SELECT user.id, user.first_name, user.last_name, user.email, user.password, user.score, country.name as country FROM user INNER JOIN country ON user.id_country = country.id where user.id = :id;';

        $stmt = $conn->prepare($sqlQueries);
        $stmt->execute(['id' => $id]);
        $results = $stmt->fetchAll();

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any user'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result['id'],
                'first_name' => $result['first_name'],
                'last_name' => $result['last_name'],
                'email' => $result['email'],
                'password' => $result['password'],
                'score' => $result['score'],
                'country' => $result['country'],
            );
        }
        return new JsonResponse($response);
    }

    public function getCountryRanking(): JsonResponse
    {

        $response = array();

        $conn = $this->getEntityManager()->getConnection();
        
        $sqlQueries = 'SELECT country.name AS country, SUM(user.score)/COUNT(user.id) AS scores FROM user INNER JOIN country ON user.id_country = country.id GROUP BY country.name ORDER BY scores DESC;';

        $stmt = $conn->prepare($sqlQueries);
        $stmt->execute();
        $results = $stmt->fetchAll();

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any user'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $key => $result) {
             array_push($response, [
                'ranking' => $key+1,
                'country' => $result['country'],
                'score' => $result['scores']]
            );
        }

        return new JsonResponse($response);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
