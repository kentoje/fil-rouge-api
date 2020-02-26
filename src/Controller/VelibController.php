<?php

namespace App\Controller;

use App\Repository\VelibRepository;
use App\Service\JsonMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class VelibController extends AbstractController
{
    /**
     * @Route("/velib", name="velibs")
     * @param VelibRepository $velibsRepo
     * @param JsonMessage $jsonMessage
     * @return JsonResponse
     */
    public function index(VelibRepository $velibsRepo, JsonMessage $jsonMessage): JsonResponse
    {
        $response = array();
        $results = $velibsRepo->findAllVelibs();

        $jsonMessage->getEmptyDataMessage($results);

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'state' => $result->getState(),
                'freedock' => $result->getFreedock(),
                'creditCard' => $result->getCreditCard(),
                'stationName' => $result->getStationName(),
                'latitude' => $result->getLatitude(),
                'longitude' => $result->getLongitude(),
                'bikeAvailable' => $result->getBikeAvailable(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/velib/{id}", name="velib")
     * @param VelibRepository $velibsRepo
     * @param JsonMessage $jsonMessage
     * @param int $id
     * @return JsonResponse
     */
    public function indexId(VelibRepository $velibsRepo, JsonMessage $jsonMessage, int $id): JsonResponse
    {
        $response = array();
        $results = $velibsRepo->findOneVelib($id);

        $jsonMessage->getEmptyDataMessage($results);

        foreach ($results as $result) {
            $response = array(
                'id' => $result->getId(),
                'state' => $result->getState(),
                'freedock' => $result->getFreedock(),
                'creditCard' => $result->getCreditCard(),
                'stationName' => $result->getStationName(),
                'latitude' => $result->getLatitude(),
                'longitude' => $result->getLongitude(),
                'bikeAvailable' => $result->getBikeAvailable(),
            );
        }
        return new JsonResponse($response);
    }
}
