<?php

namespace App\Controller;

use App\Repository\ElectricterminalDistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ElectricterminalDistController extends AbstractController
{
    /**
     * @Route("/electricterminalDist", name="electricterminal_distances")
     * @param ElectricterminalDistRepository $electricterminalDistRepo
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(ElectricterminalDistRepository $electricterminalDistRepo)
    {
        $results = $electricterminalDistRepo->findAllTerminalsDist();

        return $results;
    }

    /**
     * @Route("/electricterminalDist/{id}", name="electricterminal_distance")
     * @param ElectricterminalDistRepository $electricterminalDistRepo
     * @param $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexId(ElectricterminalDistRepository $electricterminalDistRepo, $id)
    {
        $result = $electricterminalDistRepo->findTerminalDistByIdMonument($id);

        return $result;
    }

    /**
     * @Route("/electricterminalDist/{id}/{dist}", name="electricterminal_distance2")
     * @param ElectricterminalDistRepository $electricterminalDistRepo
     * @param $id
     * @param $dist
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexIdDist(ElectricterminalDistRepository $electricterminalDistRepo, $id, $dist)
    {
        $result = $electricterminalDistRepo->findTerminalDistByIdMonumentAndDist($id,$dist);

        return $result;
    }
}
