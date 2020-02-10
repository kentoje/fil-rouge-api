<?php

namespace App\Controller;

use App\Repository\TrimobileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class TrimobileController extends AbstractController
{
    /**
     * @Route("/trimobile", name="trimobiles")
     * @param TrimobileRepository $trimobileRepo
     * @return JsonResponse
     */
    public function index(TrimobileRepository $trimobileRepo)
    {
        $results = $trimobileRepo->findAllTrimobiles();

        return $results;
    }

    /**
     * @Route("/trimobile/{id}", name="trimobile")
     * @param TrimobileRepository $trimobileRepo
     * @param $id
     * @return JsonResponse
     */
    public function indexId(TrimobileRepository $trimobileRepo, int $id)
    {
        $result = $trimobileRepo->findOneTrimobile($id);

        return $result;
    }
}
