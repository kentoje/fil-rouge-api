<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

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

    public function findAllUsers(): array
    {

        $conn = $this->getEntityManager()->getConnection();
        
        $sqlQueries = 'SELECT user.id, user.first_name, user.last_name, user.email, user.password, user.score, country.name as country FROM user INNER JOIN country ON user.id_country = country.id;';

        $stmt = $conn->prepare($sqlQueries);
        $stmt->execute();
        $results = $stmt->fetchAll();

        return $results;
    }

    public function findOneUser(int $id): array
    {

        $conn = $this->getEntityManager()->getConnection();
        
        $sqlQueries = 'SELECT user.id, user.first_name, user.last_name, user.email, user.password, user.score, country.name as country FROM user INNER JOIN country ON user.id_country = country.id where user.id = :id;';

        $stmt = $conn->prepare($sqlQueries);
        $stmt->execute(['id' => $id]);
        $results = $stmt->fetchAll();

        return $results;
    }

    public function getCountryRanking(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sqlQueries = 'SELECT country.name AS country, country.img_url, country.flag ,SUM(user.score)/COUNT(user.id) AS scores, SUM(user.score) AS scoresNotAverage FROM user INNER JOIN country ON user.id_country = country.id GROUP BY country.name, country.img_url, country.flag ORDER BY scoresNotAverage DESC;';

        $stmt = $conn->prepare($sqlQueries);
        $stmt->execute();
        $results = $stmt->fetchAll();

        return $results;
    }

    public function getCountryRankingNotAverage(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        
        $sqlQueries = 'SELECT country.name AS country, country.img_url, country.flag ,SUM(user.score) AS scores FROM user INNER JOIN country ON user.id_country = country.id GROUP BY country.name, country.img_url, country.flag ORDER BY scores DESC;';

        $stmt = $conn->prepare($sqlQueries);
        $stmt->execute();
        $results = $stmt->fetchAll();

        return $results;
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
