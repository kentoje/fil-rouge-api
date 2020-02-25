<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="users")
     * @param UserRepository $usersRepo
     * @return JsonResponse
     */
    public function index(UserRepository $usersRepo): JsonResponse
    {
        $results = $usersRepo->findAllUsers();

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

    /**
     * @Route("/user/{id}", name="user")
     * @param UserRepository $user
     * @param $id
     * @return JsonResponse
     */
    public function indexId(UserRepository $user, int $id): JsonResponse
    {
        $results = $user->findOneUser($id);

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

    /**
     * @Route("/country-ranking/", name="rankingCountry")
     * @param UserRepository $user
     * @return JsonResponse
     */
    public function indexRanking(UserRepository $user): JsonResponse
    {
        $response = array();

        $results = $user->getCountryRanking();

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any user'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $key => $result) {
            array_push($response, [
                'ranking' => $key+1,
                'country' => $result['country'],
                'score' => $result['scores'],
                'img_url' => $result['img_url'],
                'flag' => $result['flag']]
            );
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/country-ranking-not-average/", name="rankingCountryNotAverage")
     * @param UserRepository $user
     * @return JsonResponse
     */
    public function indexRankingNotAverage(UserRepository $user): JsonResponse
    {
        $response = array();

        $results = $user->getCountryRankingNotAverage();

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any user'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $key => $result) {
            array_push($response, [
                'ranking' => $key+1,
                'country' => $result['country'],
                'score' => $result['scores'],
                'img_url' => $result['img_url'],
                'flag' => $result['flag']]
            );
        }

        return new JsonResponse($response);
    }
}
