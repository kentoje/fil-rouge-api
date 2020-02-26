<?php

namespace App\Controller;

use App\Repository\VelibRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class VelibController extends AbstractController
{
    /**
     * @Route("/velib", name="velibs")
     * @param VelibRepository $velibsRepo
     * @return JsonResponse
     */
    public function index(VelibRepository $velibsRepo): JsonResponse
    {
        $response = array();
        $results = $velibsRepo->findAllVelibs();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

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
     * @param $id
     * @return JsonResponse
     */
    public function indexId(VelibRepository $velibsRepo, int $id): JsonResponse
    {
        $response = array();
        $results = $velibsRepo->findOneVelib($id);

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any velib'], Response::HTTP_NOT_FOUND);
        }

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
