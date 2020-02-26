<?php

namespace App\Controller;

use App\Repository\TrimobileDistRepository;
use App\Service\JsonMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TrimobileDistController extends AbstractController
{
    /**
     * @Route("/trimobile-dist", name="trimobile_distances")
     * @param TrimobileDistRepository $trimobileDistRepo
     * @param JsonMessage $jsonMessage
     * @return JsonResponse
     */
    public function index(TrimobileDistRepository $trimobileDistRepo, JsonMessage $jsonMessage): JsonResponse
    {
        $response = array();
        $results = $trimobileDistRepo->findAllTrimobileDist();

        $jsonMessage->getEmptyDataMessage($results);

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_km' => $result->getDistanceKm(),
                'id_trimobile' => $result->getIdTrimobile()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/trimobile-dist/{id}", name="trimobile_distance")
     * @param TrimobileDistRepository $trimobileDistRepo
     * @param JsonMessage $jsonMessage
     * @param int $id
     * @return JsonResponse
     */
    public function indexId(TrimobileDistRepository $trimobileDistRepo, JsonMessage $jsonMessage, int $id): JsonResponse
    {
        $response = array();
        $results = $trimobileDistRepo->findTrimobileDistByIdMonument($id);

        $jsonMessage->getEmptyDataMessage($results);

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_km' => $result->getDistanceKm(),
                'id_trimobile' => $result->getIdTrimobile()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/trimobile-dist/{id}/{dist}", name="trimobileDist_distance2")
     * @param TrimobileDistRepository $trimobileDistRepo
     * @param JsonMessage $jsonMessage
     * @param int $id
     * @param int $dist
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexIdDist(TrimobileDistRepository $trimobileDistRepo, JsonMessage $jsonMessage, int $id, int $dist): JsonResponse
    {
        $response = array();
        $results = $trimobileDistRepo->findTrimobileDistByIdMonumentAndDist($id, $dist);

        $jsonMessage->getEmptyDataMessage($results);

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_m' => $result->getDistanceKm(),
                'id_trimobile' => $result->getIdTrimobile()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }
}
