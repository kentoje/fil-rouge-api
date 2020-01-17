<?php

namespace App\Controller;

use App\Repository\TrilibDistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrilibDistController extends AbstractController
{
    /**
     * @Route("/trilib-dist", name="trilib_distances")
     * @param TrilibDistRepository $trilibDistRepository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(TrilibDistRepository $trilibDistRepository)
    {
        $results = $trilibDistRepository->findAllTrilibDist();

        return $results;
    }

    /**
     * @Route("/trilib-dist/{id}", name="trilib_distance")
     * @param TrilibDistRepository $trilibDistRepository
     * @param $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexId(TrilibDistRepository $trilibDistRepository, $id)
    {
        $result = $trilibDistRepository->findTrilibDistByIdMonument($id);

        return $result;
    }

    /**
     * @Route("/trilib-dist/{id}/{dist}", name="trilib_distance2")
     * @param TrilibDistRepository $trilibDistRepository
     * @param $id
     * @param $dist
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexIdDist(TrilibDistRepository $trilibDistRepository, $id, $dist)
    {
        $result = $trilibDistRepository->findTrilibDistByIdMonumentAndDist($id, $dist);

        return $result;
    }
}
