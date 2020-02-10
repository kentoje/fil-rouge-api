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
        $results = $recordsWastesRepo->findAllRecordsWastes();

        return $results;
    }

    /**
     * @Route("/records-waste/{id}", name="record_waste")
     * @param RecordsWasteRepository $recordsWastes
     * @param $id
     * @return JsonResponse
     */
    public function indexId(RecordsWasteRepository $recordsWastes, $id)
    {
        $result = $recordsWastes->findOneRecordWaste($id);

        return $result;
    }

    /**
     * @Route("/records-waste-multiplicateur/{numberDay}/{foreignerPeople}", name="records_waste_multiplicateur")
     * @param RecordsWasteRepository $recordsWastes
     * @param $numberDay
     * @param $foreignerPeople
     * @return JsonResponse
     */
    public function indexMulti(RecordsWasteRepository $recordsWastes, int $numberDay, string $foreignerPeople)
    {
        $result = $recordsWastes->findAllRecordsWastesByMultiplication($numberDay, $foreignerPeople);

        return $result;
    }

    /**
     * @Route("/records-waste-multiplicateur/{numberDay}/{foreignerPeople}/{id}", name="record_waste_multiplicateur")
     * @param RecordsWasteRepository $recordsWastes
     * @param $numberDay
     * @param $foreignerPeople
     * @param $id
     * @return JsonResponse
     */
    public function indexIdMulti(RecordsWasteRepository $recordsWastes, int $numberDay, string $foreignerPeople, int $id)
    {
        $result = $recordsWastes->findOneRecordWasteByMultiplication($numberDay, $foreignerPeople, $id);

        return $result;
    }
}
