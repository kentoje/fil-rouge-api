<?php

namespace App\Controller;

use App\Repository\WasteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class WasteController extends AbstractController
{
    /**
     * @Route("/waste", name="wastes")
     * @param WasteRepository $wastesRepo
     * @return JsonResponse
     */
    public function index(WasteRepository $wastesRepo)
    {
        $result = $wastesRepo->findAllWastes();

        return $result;
    }

    /**
     * @Route("/waste/{id}", name="waste")
     * @param WasteRepository $waste
     * @param $id
     * @return JsonResponse
     */
    public function indexId(WasteRepository $waste, $id)
    {
        $result = $waste->findOneWaste($id);

        return $result;
    }
}
