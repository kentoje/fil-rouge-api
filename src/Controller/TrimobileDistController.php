<?php

namespace App\Controller;

use App\Repository\TrimobileDistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TrimobileDistController extends AbstractController
{
    /**
     * @Route("/trimobileDist", name="trimobile_distances")
     * @param TrimobileDistRepository $trimobileDistRepo
     * @return JsonResponse
     */
    public function index(TrimobileDistRepository $trimobileDistRepo)
    {
        $result = $trimobileDistRepo->findAllTrimobileDist();

        return $result;
    }

    /**
     * @Route("/trimobileDist/{id}", name="trimobile_distance")
     * @param TrimobileDistRepository $trimobileDistRepo
     * @param $id
     * @return JsonResponse
     */
    public function indexId(TrimobileDistRepository $trimobileDistRepo, $id)
    {
        $result = $trimobileDistRepo->findTrimobileDistByIdMonument($id);

        return $result;
    }

     /**
     * @Route("/trimobileDist/{id}/{dist}", name="trimobileDist_distance2")
     * @param TrimobileDistRepository $trimobileDistRepo
     * @param $id
     * @param $dist
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexIdDist(TrimobileDistRepository $trimobileDistRepo, $id, $dist)
    {
        $result = $trimobileDistRepo->findTrimobileDistByIdMonumentAndDist($id, $dist);

        return $result;
    }
}
