<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="users")
     * @param UserRepository $usersRepo
     * @return JsonResponse
     */
    public function index(UserRepository $usersRepo)
    {
        $result = $usersRepo->findAllUsers();

        return $result;
    }

    /**
     * @Route("/user/{id}", name="user")
     * @param UserRepository $user
     * @param $id
     * @return JsonResponse
     */
    public function indexId(UserRepository $user, int $id)
    {
        $result = $user->findOneUser($id);

        return $result;
    }
}
