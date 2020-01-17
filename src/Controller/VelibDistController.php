<?php

namespace App\Controller;

use App\Repository\VelibDistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class VelibDistController extends AbstractController
{
    /**
     * @Route("/velib-dist", name="velib_distances")
     * @param VelibDistRepository $VelibDistRepo
     * @return JsonResponse
     */
    public function index(VelibDistRepository $VelibDistRepo)
    {
        $result = $VelibDistRepo->findAllVelibDist();

        return $result;
    }

    /**
     * @Route("/velib-dist/{id}", name="velib_distance")
     * @param VelibDistRepository $VelibDistRepo
     * @param $id
     * @return JsonResponse
     */
    public function indexId(VelibDistRepository $VelibDistRepo, $id)
    {
        $result = $VelibDistRepo->findTrilibDistByIdMonument($id);

        return $result;
    }

         /**
     * @Route("/velib-dist/{id}/{dist}", name="velib_distance2")
     * @param VelibDistRepository $VelibDistRepo
     * @param $id
     * @param $dist
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexIdDist(VelibDistRepository $VelibDistRepo, $id, $dist)
    {
        $result = $VelibDistRepo->findTrilibDistByIdMonumentAndDist($id, $dist);

        return $result;
    }
}
