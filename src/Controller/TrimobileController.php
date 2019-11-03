<?php

namespace App\Controller;

use App\Repository\TrimobileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class TrimobileController extends AbstractController
{
    /**
     * @Route("/trimobiles", name="trimobiles")
     * @param TrimobileRepository $trimobileRepo
     * @return JsonResponse
     */
    public function index(TrimobileRepository $trimobileRepo)
    {
        $results = $trimobileRepo->findAllTrimobiles();

        return new JsonResponse($results);
    }

    /**
     * @Route("/trimobiles/{id}", name="trimobile")
     * @param TrimobileRepository $trimobileRepo
     * @param $id
     * @return JsonResponse
     */
    public function indexId(TrimobileRepository $trimobileRepo, $id)
    {
        $result = $trimobileRepo->findOneTrimobile($id);

        return new JsonResponse($result);
    }
}
