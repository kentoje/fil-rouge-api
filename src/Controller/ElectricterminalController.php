<?php

namespace App\Controller;

use App\Repository\ElectricterminalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ElectricterminalController extends AbstractController
{
    /**
     * @Route("/electricterminal", name="electricterminals")
     * @param ElectricterminalRepository $electricterminalRepo
     * @return JsonResponse
     */
    public function index(ElectricterminalRepository $electricterminalRepo)
    {
        $results = $electricterminalRepo->findAllTerminals();

        return new JsonResponse($results);
    }

    /**
     * @Route("/electricterminal/{id}", name="electricterminal")
     * @param ElectricterminalRepository $electricterminalRepo
     * @return JsonResponse
     * @param $id
     */
    public function indexId(ElectricterminalRepository $electricterminalRepo, $id)
    {
        $result = $electricterminalRepo->findOneTerminal($id);

        return new JsonResponse($result);
    }
}