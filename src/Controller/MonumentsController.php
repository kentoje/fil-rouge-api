<?php

namespace App\Controller;

use App\Repository\MonumentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class MonumentsController extends AbstractController
{
    /**
     * @Route("/monuments", name="monuments")
     * @param MonumentsRepository $monumentsRepo
     * @return JsonResponse
     */
    public function index(MonumentsRepository $monumentsRepo)
    {
        $results = $monumentsRepo->findAllMonuments();

        return new JsonResponse($results);
    }

    /**
     * @Route("/monuments/{id}", name="monument")
     * @param MonumentsRepository $monumentsRepo
     * @param $id
     * @return JsonResponse
     */
    public function indexId(MonumentsRepository $monumentsRepo, $id)
    {
        $result = $monumentsRepo->findOneMonument($id);

        return new JsonResponse($result);
    }
}
