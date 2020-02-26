<?php

namespace App\Controller;

use App\Repository\RecordsWasteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecordsWasteController extends AbstractController
{
    /**
     * @Route("/records-waste", name="records_waste")
     * @param RecordsWasteRepository $recordsWastesRepo
     * @return JsonResponse
     */
    public function index(RecordsWasteRepository $recordsWastesRepo): JsonResponse
    {
        $response = array();
        $results = $recordsWastesRepo->findAllRecordsWastes();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

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
     * @param $id
     * @return JsonResponse
     */
    public function indexId(RecordsWasteRepository $recordsWastes, int $id): JsonResponse
    {
        $response = array();
        $results = $recordsWastes->findOneRecordWaste($id);

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any waste'], Response::HTTP_NOT_FOUND);
        }

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
     * @param $numberDay
     * @param $foreignerPeople
     * @return JsonResponse
     */
    public function indexMulti(RecordsWasteRepository $recordsWastes, int $numberDay, string $foreignerPeople): JsonResponse
    {
        $response = array();
        $results = $recordsWastes->findAllRecordsWastesByMultiplication();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

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
     * @param $numberDay
     * @param $foreignerPeople
     * @param $id
     * @return JsonResponse
     */
    public function indexIdMulti(RecordsWasteRepository $recordsWastes, int $numberDay, string $foreignerPeople, int $id): JsonResponse
    {
        $response = array();
        $results = $recordsWastes->findOneRecordWasteByMultiplication($id);

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any waste'], Response::HTTP_NOT_FOUND);
        }

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
