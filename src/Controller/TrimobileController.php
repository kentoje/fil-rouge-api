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
     * @param TrimobileController $trimobileRepo
     * @return JsonResponse
     */
    public function index(TrimobileRepository $trimobileRepo)
    {
        $results = $trimobileRepo->findAllMonuments();

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
        $result = $trimobileRepo->findOneMonument($id);

        return new JsonResponse($result);
    }
}
