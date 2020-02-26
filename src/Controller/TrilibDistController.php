<?php

namespace App\Controller;

use App\Repository\TrilibDistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TrilibDistController extends AbstractController
{
    /**
     * @Route("/trilib-dist", name="trilib_distances")
     * @param TrilibDistRepository $trilibDistRepository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(TrilibDistRepository $trilibDistRepository): JsonResponse
    {
        $response = array();
        $results = $trilibDistRepository->findAllTrilibDist();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
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
     * @param $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexId(TrilibDistRepository $trilibDistRepository, int $id): JsonResponse
    {
        $response = array();
        $results = $trilibDistRepository->findTrilibDistByIdMonument($id);

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
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
     * @param $id
     * @param $dist
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexIdDist(TrilibDistRepository $trilibDistRepository, int $id, int $dist): JsonResponse
    {
        $response = array();
        $results = $trilibDistRepository->findTrilibDistByIdMonumentAndDist($id, $dist);

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
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
