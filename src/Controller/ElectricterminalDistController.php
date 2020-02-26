<?php

namespace App\Controller;

use App\Repository\ElectricterminalDistRepository;
use App\Service\JsonMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ElectricterminalDistController extends AbstractController
{
    /**
     * @Route("/electricterminal-dist", name="electricterminal_distances")
     * @param ElectricterminalDistRepository $electricterminalDistRepo
     * @param JsonMessage $jsonMessage
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(ElectricterminalDistRepository $electricterminalDistRepo, JsonMessage $jsonMessage): JsonResponse
    {
        $response = array();
        $results = $electricterminalDistRepo->findAllTerminalsDist();

        $jsonMessage->getEmptyDataMessage($results);

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_m' => $result->getDistanceKm(),
                'id_electricterminal' => $result->getIdElectricterminal()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/electricterminal-dist/{id}", name="electricterminal_distance")
     * @param ElectricterminalDistRepository $electricterminalDistRepo
     * @param $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexId(ElectricterminalDistRepository $electricterminalDistRepo, JsonMessage $jsonMessage, int $id): JsonResponse
    {
        $response = array();
        $results = $electricterminalDistRepo->findTerminalDistByIdMonument($id);

        $jsonMessage->getEmptyDataMessage($results);

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_m' => $result->getDistanceKm(),
                'id_electricterminal' => $result->getIdElectricterminal()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/electricterminal-dist/{id}/{dist}", name="electricterminal_distance2")
     * @param ElectricterminalDistRepository $electricterminalDistRepo
     * @param $id
     * @param $dist
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexIdDist(ElectricterminalDistRepository $electricterminalDistRepo, JsonMessage $jsonMessage, int $id, int $dist): JsonResponse
    {
        $response = array();
        $results = $electricterminalDistRepo->findTerminalDistByIdMonumentAndDist($id,$dist);

        $jsonMessage->getEmptyDataMessage($results);

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'distance_m' => $result->getDistanceKm(),
                'id_electricterminal' => $result->getIdElectricterminal()->getId(),
                'id_monuments' => $result->getIdMonuments()->getId(),
            );
        }
        return new JsonResponse($response);
    }
}
