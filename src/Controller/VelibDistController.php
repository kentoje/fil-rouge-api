<?php

namespace App\Controller;

use App\Repository\VelibDistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class VelibDistController extends AbstractController
{
    /**
     * @Route("/velibDist", name="velib_distances")
     * @param VelibDistRepository $VelibDistRepo
     * @return JsonResponse
     */
    public function index(VelibDistRepository $VelibDistRepo)
    {
        $result = $VelibDistRepo->findAllVelibDist();

        return $result;
    }

    /**
     * @Route("/velibDist/{id}", name="velib_distance")
     * @param VelibDistRepository $VelibDistRepo
     * @param $id
     * @return JsonResponse
     */
    public function indexId(VelibDistRepository $VelibDistRepo, $id)
    {
        $result = $VelibDistRepo->findTrilibDistByIdMonument($id);

        return $result;
    }
}
