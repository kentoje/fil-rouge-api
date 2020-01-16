<?php

namespace App\Controller;

use App\Repository\ElectricterminalDistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ElectricterminalDistController extends AbstractController
{
    /**
     * @Route("/electricterminalDist", name="electricterminal_distances")
     */
    public function index(ElectricterminalDistRepository $electricterminalDistRepo)
    {
        $results = $electricterminalDistRepo->findAllTerminalsDist();

        return $results;
    }

    /**
     * @Route("/electricterminalDist/{id}", name="electricterminal_distance")
     */
    public function indexId(ElectricterminalDistRepository $electricterminalDistRepo, $id)
    {
        $result = $electricterminalDistRepo->findTerminalDistByIdMonument($id);

        return $result;
    }
}
