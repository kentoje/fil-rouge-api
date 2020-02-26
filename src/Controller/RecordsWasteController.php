<?php

namespace App\Controller;

use App\Repository\RecordsWasteRepository;
use App\Service\JsonMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RecordsWasteController extends AbstractController
{
    /**
     * @Route("/records-waste", name="records_waste")
     * @param RecordsWasteRepository $recordsWastesRepo
     * @param JsonMessage $jsonMessage
     * @return JsonResponse
     */
    public function index(RecordsWasteRepository $recordsWastesRepo, JsonMessage $jsonMessage): JsonResponse
    {
        $response = array();
        $results = $recordsWastesRepo->findAllRecordsWastes();

        $jsonMessage->getEmptyDataMessage($results);

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'name' => $result->getName(),
                'tons' => $result->getTons(),
                'is_recyclabe' => $result->getIsRecyclabe(),
            );
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/records-waste/{id}", name="record_waste")
     * @param RecordsWasteRepository $recordsWastes
     * @param JsonMessage $jsonMessage
     * @param int $id
     * @return JsonResponse
     */
    public function indexId(RecordsWasteRepository $recordsWastes, JsonMessage $jsonMessage, int $id): JsonResponse
    {
        $response = array();
        $results = $recordsWastes->findOneRecordWaste($id);

        $jsonMessage->getEmptyDataMessage($results);

        foreach ($results as $result) {
            $response = array(
                'id' => $result->getId(),
                'name' => $result->getName(),
                'tons' => $result->getTons(),
                'is_recyclabe' => $result->getIsRecyclabe(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/records-waste-multiplicateur/{numberDay}/{foreignerPeople}", name="records_waste_multiplicateur")
     * @param RecordsWasteRepository $recordsWastes
     * @param JsonMessage $jsonMessage
     * @param int $numberDay
     * @param string $foreignerPeople
     * @return JsonResponse
     */
    public function indexMulti(RecordsWasteRepository $recordsWastes, JsonMessage $jsonMessage, int $numberDay, string $foreignerPeople): JsonResponse
    {
        $response = array();
        $results = $recordsWastes->findAllRecordsWastesByMultiplication();

        $jsonMessage->getEmptyDataMessage($results);

        if ($foreignerPeople === 'true'){
            foreach ($results as $result) {
                $response[] = array(
                    'id' => $result->getId(),
                    'name' => $result->getName(),
                    'tons' => $result->getTons() * ($numberDay * 1.23),
                    'is_recyclabe' => $result->getIsRecyclabe(),
                );
            }
        } else if ($foreignerPeople === 'false') {
            foreach ($results as $result) {
                $response[] = array(
                    'id' => $result->getId(),
                    'name' => $result->getName(),
                    'tons' => $result->getTons() * $numberDay,

                    'is_recyclabe' => $result->getIsRecyclabe(),
                );
            }
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/records-waste-multiplicateur/{numberDay}/{foreignerPeople}/{id}", name="record_waste_multiplicateur")
     * @param RecordsWasteRepository $recordsWastes
     * @param JsonMessage $jsonMessage
     * @param int $numberDay
     * @param string $foreignerPeople
     * @param int $id
     * @return JsonResponse
     */
    public function indexIdMulti(RecordsWasteRepository $recordsWastes, JsonMessage $jsonMessage, int $numberDay, string $foreignerPeople, int $id): JsonResponse
    {
        $response = array();
        $results = $recordsWastes->findOneRecordWasteByMultiplication($id);

        $jsonMessage->getEmptyDataMessage($results);

        if($foreignerPeople === "true") {
            foreach ($results as $result) {
                $response = array(
                    'id' => $result->getId(),
                    'name' => $result->getName(),
                    'tons' => $result->getTons() * $numberDay * 1.23,
                    'is_recyclabe' => $result->getIsRecyclabe(),
                );
            }
        } else if ($foreignerPeople === "false") {
            foreach ($results as $result) {
                $response = array(
                    'id' => $result->getId(),
                    'name' => $result->getName(),
                    'tons' => $result->getTons() * $numberDay,
                    'is_recyclabe' => $result->getIsRecyclabe(),
                );
            }
        }

        return new JsonResponse($response);
    }
}
