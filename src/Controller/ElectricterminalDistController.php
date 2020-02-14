<?php

namespace App\Controller;

use App\Repository\ElectricterminalDistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ElectricterminalDistController extends AbstractController
{
    /**
     * @Route("/electricterminal-dist", name="electricterminal_distances")
     * @param ElectricterminalDistRepository $electricterminalDistRepo
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(ElectricterminalDistRepository $electricterminalDistRepo): JsonResponse
    {
        $results = $electricterminalDistRepo->findAllTerminalsDist();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

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
    public function indexId(ElectricterminalDistRepository $electricterminalDistRepo, int $id): JsonResponse
    {
        $results = $electricterminalDistRepo->findTerminalDistByIdMonument($id);

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

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
    public function indexIdDist(ElectricterminalDistRepository $electricterminalDistRepo, int $id, int $dist): JsonResponse
    {
        $results = $electricterminalDistRepo->findTerminalDistByIdMonumentAndDist($id,$dist);

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

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
