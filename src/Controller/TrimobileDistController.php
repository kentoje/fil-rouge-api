<?php

namespace App\Controller;

use App\Repository\TrimobileDistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrimobileDistController extends AbstractController
{
    /**
     * @Route("/trimobile-dist", name="trimobile_distances")
     * @param TrimobileDistRepository $trimobileDistRepo
     * @return JsonResponse
     */
    public function index(TrimobileDistRepository $trimobileDistRepo): JsonResponse
    {
        $response = array();
        $results = $trimobileDistRepo->findAllTrimobileDist();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

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
     * @param $id
     * @return JsonResponse
     */
    public function indexId(TrimobileDistRepository $trimobileDistRepo, int $id): JsonResponse
    {
        $response = array();
        $results = $trimobileDistRepo->findTrimobileDistByIdMonument($id);

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

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
     * @param $id
     * @param $dist
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexIdDist(TrimobileDistRepository $trimobileDistRepo, int $id, int $dist): JsonResponse
    {
        $response = array();
        $results = $trimobileDistRepo->findTrimobileDistByIdMonumentAndDist($id, $dist);

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

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
