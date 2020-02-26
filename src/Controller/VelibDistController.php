<?php

namespace App\Controller;

use App\Repository\VelibDistRepository;
use App\Service\JsonMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class VelibDistController extends AbstractController
{
    /**
     * @Route("/velib-dist", name="velib_distances")
     * @param VelibDistRepository $VelibDistRepo
     * @param JsonMessage $jsonMessage
     * @return JsonResponse
     */
    public function index(VelibDistRepository $VelibDistRepo, JsonMessage $jsonMessage): JsonResponse
    {
        $response = array();
        $results = $VelibDistRepo->findAllVelibDist();

        if (!$results) {
            return $jsonMessage->getEmptyDataMessage();
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_km' => $result->getDistanceKm(),
                'id_velib' => $result->getIdVelib()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/velib-dist/{id}", name="velib_distance")
     * @param VelibDistRepository $VelibDistRepo
     * @param JsonMessage $jsonMessage
     * @param int $id
     * @return JsonResponse
     */
    public function indexId(VelibDistRepository $VelibDistRepo, JsonMessage $jsonMessage, int $id): JsonResponse
    {
        $response = array();
        $results = $VelibDistRepo->findTrilibDistByIdMonument($id);

        if (!$results) {
            return $jsonMessage->getEmptyDataMessage();
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_km' => $result->getDistanceKm(),
                'id_velib' => $result->getIdVelib()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/velib-dist/{id}/{dist}", name="velib_distance2")
     * @param VelibDistRepository $VelibDistRepo
     * @param JsonMessage $jsonMessage
     * @param int $id
     * @param int $dist
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexIdDist(VelibDistRepository $VelibDistRepo, JsonMessage $jsonMessage, int $id, int $dist): JsonResponse
    {
        $response = array();
        $results = $VelibDistRepo->findTrilibDistByIdMonumentAndDist($id, $dist);

        if (!$results) {
            return $jsonMessage->getEmptyDataMessage();
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_m' => $result->getDistanceKm(),
                'id_velib' => $result->getIdVelib()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }
}
