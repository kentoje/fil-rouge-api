<?php

namespace App\Controller;

use App\Repository\ElectricterminalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ElectricterminalController extends AbstractController
{
    /**
     * @Route("/electricterminal", name="electricterminals")
     * @param ElectricterminalRepository $electricterminalRepo
     * @return JsonResponse
     */
    public function index(ElectricterminalRepository $electricterminalRepo): JsonResponse
    {   
        $response = array();
        $results = $electricterminalRepo->findAllTerminals();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'schedule' => $result->getSchedule(),
                'aftersalesPhone' => $result->getAftersalesPhone(),
                'latitude' => $result->getLatitude(),
                'longitude' => $result->getLongitude(),
                'electricType' => $result->getElectricType(),
                'connectorType' => $result->getConnectorType(),
                'city' => $result->getCity(),
                'address' => $result->getAddress(),
                'zipcode' => $result->getZipcode(),
                'watt' => $result->getWatt(),
                'stationName' => $result->getStationName(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/electricterminal/{id}", name="electricterminal")
     * @param ElectricterminalRepository $electricterminalRepo
     * @return JsonResponse
     * @param $id
     */
    public function indexId(ElectricterminalRepository $electricterminalRepo, int $id): JsonResponse
    {
        $response = array();
        $results = $electricterminalRepo->findOneTerminal($id);

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response = array(
                'id' => $result->getId(),
                'schedule' => $result->getSchedule(),
                'aftersalesPhone' => $result->getAftersalesPhone(),
                'latitude' => $result->getLatitude(),
                'longitude' => $result->getLongitude(),
                'electricType' => $result->getElectricType(),
                'connectorType' => $result->getConnectorType(),
                'city' => $result->getCity(),
                'address' => $result->getAddress(),
                'zipcode' => $result->getZipcode(),
                'watt' => $result->getWatt(),
                'stationName' => $result->getStationName(),
            );
        }
        return new JsonResponse($response);
    }
}
