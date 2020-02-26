<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\JsonMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="users")
     * @param UserRepository $usersRepo
     * @param JsonMessage $jsonMessage
     * @return JsonResponse
     */
    public function index(UserRepository $usersRepo, JsonMessage $jsonMessage): JsonResponse
    {
        $response = array();
        $results = $usersRepo->findAllUsers();

        $jsonMessage->getEmptyDataMessage($results);

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

    /**
     * @Route("/user/{id}", name="user")
     * @param UserRepository $user
     * @param JsonMessage $jsonMessage
     * @param int $id
     * @return JsonResponse
     */
    public function indexId(UserRepository $user, JsonMessage $jsonMessage, int $id): JsonResponse
    {
        $response = array();
        $results = $user->findOneUser($id);

        $jsonMessage->getEmptyDataMessage($results);

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

    /**
     * @Route("/country-ranking/", name="rankingCountry")
     * @param UserRepository $user
     * @param JsonMessage $jsonMessage
     * @return JsonResponse
     */
    public function indexRanking(UserRepository $user, JsonMessage $jsonMessage): JsonResponse
    {
        $response = array();
        $results = $user->getCountryRanking();

        $jsonMessage->getEmptyDataMessage($results);

        foreach ($results as $key => $result) {
            array_push($response, [
                'ranking' => $key + 1,
                'country' => $result['country'],
                'score' => $result['scores'],
                'scoresNotAverage' => $result['scoresNotAverage'],
                'img_url' => $result['img_url'],
                'flag' => $result['flag']]
            );
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/country-ranking-not-average/", name="rankingCountryNotAverage")
     * @param UserRepository $user
     * @param JsonMessage $jsonMessage
     * @return JsonResponse
     */
    public function indexRankingNotAverage(UserRepository $user, JsonMessage $jsonMessage): JsonResponse
    {
        $response = array();
        $results = $user->getCountryRankingNotAverage();

        $jsonMessage->getEmptyDataMessage($results);

        foreach ($results as $key => $result) {
            array_push($response, [
                'ranking' => $key + 1,
                'country' => $result['country'],
                'score' => $result['scores'],
                'img_url' => $result['img_url'],
                'flag' => $result['flag']]
            );
        }

        return new JsonResponse($response);
    }
}
