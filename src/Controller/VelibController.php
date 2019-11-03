<?php

namespace App\Controller;

use App\Repository\VelibRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class VelibController extends AbstractController
{
    /**
     * @Route("/velibs", name="velibs")
     * @param VelibRepository $velibsRepo
     * @return JsonResponse
     */
    public function index(VelibRepository $velibsRepo)
    {
        $results = $velibsRepo->findAllVelibs();

        return new JsonResponse($results);
    }

    /**
     * @Route("/velibs/{id}", name="velib")
     * @param VelibRepository $velibsRepo
     * @param $id
     * @return JsonResponse
     */
    public function indexId(VelibRepository $velibsRepo, $id)
    {
        $result = $velibsRepo->findOneVelib($id);

        return new JsonResponse($result);
    }
}
