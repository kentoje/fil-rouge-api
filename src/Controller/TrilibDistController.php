<?php

namespace App\Controller;

use App\Repository\TrilibDistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrilibDistController extends AbstractController
{
    /**
     * @Route("/trilibDist", name="trilib_distances")
     */
    public function index(TrilibDistRepository $trilibDistRepository)
    {
        $results = $trilibDistRepository->findAllTrilibDist();

        return $results;
    }

    /**
     * @Route("/trilibDist/{id}", name="trilib_distance")
     */
    public function indexId(TrilibDistRepository $trilibDistRepository, $id)
    {
        $result = $trilibDistRepository->findTrilibDistByIdMonument($id);

        return $result;
    }

    /**
     * @Route("/trilibDist/{id}/{dist}", name="trilib_distance2")
     */
    public function indexIdDist(TrilibDistRepository $trilibDistRepository, $id, $dist)
    {
        $result = $trilibDistRepository->findTrilibDistByIdMonumentAndDist($id, $dist);

        return $result;
    }
}
