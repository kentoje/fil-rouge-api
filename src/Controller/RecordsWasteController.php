<?php

namespace App\Controller;

use App\Repository\RecordsWasteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RecordsWasteController extends AbstractController
{
    /**
     * @Route("/records-waste", name="records_waste")
     * @param RecordsWasteRepository $recordsWastesRepo
     * @return JsonResponse
     */
    public function index(RecordsWasteRepository $recordsWastesRepo)
    {
        $result = $recordsWastesRepo->findAllRecordsWastes();

        return $result;
    }

    /**
     * @Route("/records-waste/{id}", name="record_waste")
     * @param RecordsWasteRepository $recordsWastes
     * @param $id
     * @return JsonResponse
     */
    public function indexId(RecordsWasteRepository $recordsWastes, $id)
    {
        $result = $recordsWastes->findOneRecodWaste($id);

        return $result;
    }
}
