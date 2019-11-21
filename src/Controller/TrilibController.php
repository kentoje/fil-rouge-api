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
    public function indexId(TrilibRepository $trilibRepo, $id)
    {
        $result = $trilibRepo->findOneTrilib($id);

        return $result;
    }
}
