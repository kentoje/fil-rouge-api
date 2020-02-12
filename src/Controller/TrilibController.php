<?php

namespace App\Controller;

use App\Repository\TrilibRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class TrilibController extends AbstractController
{
    /**
     * @Route("/trilib", name="trilibs")
     * @param TrilibRepository $trilibRepo
     * @return JsonResponse
     */
    public function index(TrilibRepository $trilibRepo)
    {
        $results = $trilibRepo->findAllTrilibs();

        return $results;
    }

    /**
     * @Route("/trilib/{id}", name="trilib")
     * @param TrilibRepository $trilibRepo
     * @param $id
     * @return JsonResponse
     */
    public function indexId(TrilibRepository $trilibRepo, int $id)
    {
        $result = $trilibRepo->findOneTrilib($id);

        return $result;
    }

    /**
     * @Route("/trilibs/{tabId}", name="trilibMany")
     * @param TrilibRepository $trilibRepo
     * @param $tabId
     * @return JsonResponse
     */
    public function indexIdMany(TrilibRepository $trilibRepo, $tabId)
    {
        $result = $trilibRepo->findMultipleTrilib($tabId);

        return $result;
    }
}
