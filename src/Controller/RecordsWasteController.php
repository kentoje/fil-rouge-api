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

    /**
     * @Route("/records-waste-multiplicateur/{nbJour}/{olympique}", name="records_waste_multiplicateur")
     * @param RecordsWasteRepository $recordsWastes
     * @param $nbJour
     * @param $olympique
     * @return JsonResponse
     */
    public function indexMulti(RecordsWasteRepository $recordsWastes, $nbJour, $olympique)
    {
        $result = $recordsWastes->findAllRecordsWastesByMultiplicateur($nbJour, $olympique);

        return $result;
    }

    /**
     * @Route("/records-waste-multiplicateur/{nbJour}/{olympique}/{id}", name="record_waste_multiplicateur")
     * @param RecordsWasteRepository $recordsWastes
     * @param $nbJour
     * @param $olympique
     * @param $id
     * @return JsonResponse
     */
    public function indexIdMulti(RecordsWasteRepository $recordsWastes, $nbJour, $olympique, $id)
    {
        $result = $recordsWastes->findOneRecodWasteByMultiplicateur($nbJour, $olympique, $id);

        return $result;
    }
}
