<?php

namespace App\Controller;

use App\Repository\TrimobileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class TrimobileController extends AbstractController
{
    /**
     * @Route("/trimobile", name="trimobiles")
     * @param TrimobileRepository $trimobileRepo
     * @return JsonResponse
     */
    public function index(TrimobileRepository $trimobileRepo)
    {
        $results = $trimobileRepo->findAllTrimobiles();

        return $results;
    }

    /**
     * @Route("/trimobile/{id}", name="trimobile")
     * @param TrimobileRepository $trimobileRepo
     * @param $id
     * @return JsonResponse
     */
    public function indexId(TrimobileRepository $trimobileRepo, int $id)
    {
        $result = $trimobileRepo->findOneTrimobile($id);

        return $result;
    }

    /**
     * @Route("/trimobiles/{tabId}", name="trimobileMany")
     * @param TrimobileRepository $trimobileRepo
     * @param $tabId
     * @return JsonResponse
     */
    public function indexIdMany(TrimobileRepository $trimobileRepo, $tabId)
    {
        $result = $trimobileRepo->findMultipleTrimobile($tabId);

        return $result;
    }

    /**
     * @Route("/trimobiles/{tabId}/{limit}", name="trimobileManyLimit")
     * @param TrimobileRepository $trimobileRepo
     * @param $tabId
     * @param $limit
     * @return JsonResponse
     */
    public function indexIdManyLimit(TrimobileRepository $trimobileRepo, $tabId, $limit)
    {
        $result = $trimobileRepo->findMultipleTrimobilewithLimit($tabId,$limit);

        return $result;
    }

}
