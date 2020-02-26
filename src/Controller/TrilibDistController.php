<?php

namespace App\Controller;

use App\Repository\TrilibDistRepository;
use App\Service\JsonMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class TrilibDistController extends AbstractController
{
    /**
     * @Route("/trilib-dist", name="trilib_distances")
     * @param TrilibDistRepository $trilibDistRepository
     * @param JsonMessage $jsonMessage
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(TrilibDistRepository $trilibDistRepository, JsonMessage $jsonMessage): JsonResponse
    {
        $response = array();
        $results = $trilibDistRepository->findAllTrilibDist();

        if (!$results) {
            return $jsonMessage->getEmptyDataMessage();
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_m' => $result->getDistanceKm(),
                'id_trilib' => $result->getIdTrilib()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/trilib-dist/{id}", name="trilib_distance")
     * @param TrilibDistRepository $trilibDistRepository
     * @param JsonMessage $jsonMessage
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexId(TrilibDistRepository $trilibDistRepository, JsonMessage $jsonMessage, int $id): JsonResponse
    {
        $response = array();
        $results = $trilibDistRepository->findTrilibDistByIdMonument($id);

        if (!$results) {
            return $jsonMessage->getEmptyDataMessage();
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_m' => $result->getDistanceKm(),
                'id_trilib' => $result->getIdTrilib()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/trilib-dist/{id}/{dist}", name="trilib_distance2")
     * @param TrilibDistRepository $trilibDistRepository
     * @param JsonMessage $jsonMessage
     * @param int $id
     * @param int $dist
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexIdDist(TrilibDistRepository $trilibDistRepository, JsonMessage $jsonMessage, int $id, int $dist): JsonResponse
    {
        $response = array();
        $results = $trilibDistRepository->findTrilibDistByIdMonumentAndDist($id, $dist);

        if (!$results) {
            return $jsonMessage->getEmptyDataMessage();
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_m' => $result->getDistanceKm(),
                'id_trilib' => $result->getIdTrilib()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }
}
