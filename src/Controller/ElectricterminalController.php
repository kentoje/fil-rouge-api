<?php

namespace App\Controller;

use App\Repository\ElectricterminalRepository;
use App\Service\JsonMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ElectricterminalController extends AbstractController
{
    /**
     * @Route("/electricterminal", name="electricterminals")
     * @param ElectricterminalRepository $electricterminalRepo
     * @param JsonMessage $jsonMessage
     * @return JsonResponse
     */
    public function index(ElectricterminalRepository $electricterminalRepo, JsonMessage $jsonMessage): JsonResponse
    {   
        $response = array();
        $results = $electricterminalRepo->findAllTerminals();

        $jsonMessage->getEmptyDataMessage($results);

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
     * @param JsonMessage $jsonMessage
     * @param int $id
     * @return JsonResponse
     */
    public function indexId(ElectricterminalRepository $electricterminalRepo, JsonMessage $jsonMessage, int $id): JsonResponse
    {
        $response = array();
        $results = $electricterminalRepo->findOneTerminal($id);

        $jsonMessage->getEmptyDataMessage($results);

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
