<?php

namespace App\Controller;

use App\Repository\TrilibRepository;
use App\Service\JsonMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TrilibController extends AbstractController
{
    /**
     * @Route("/trilib", name="trilibs")
     * @param TrilibRepository $trilibRepo
     * @param JsonMessage $jsonMessage
     * @return JsonResponse
     */
    public function index(TrilibRepository $trilibRepo, JsonMessage $jsonMessage): JsonResponse
    {
        $response = array();
        $results = $trilibRepo->findAllTrilibs();

        if (!$results) {
            return $jsonMessage->getEmptyDataMessage();
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'latitude' => $result->getLatitude(),
                'longitude' => $result->getLongitude(),
                'wastetype' => $result->getWastetype(),
                'address' => $result->getAddress(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/trilib/{id}", name="trilib")
     * @param TrilibRepository $trilibRepo
     * @param JsonMessage $jsonMessage
     * @param int $id
     * @return JsonResponse
     */
    public function indexId(TrilibRepository $trilibRepo, JsonMessage $jsonMessage, int $id): JsonResponse
    {
        $response = array();
        $results = $trilibRepo->findOneTrilib($id);

        if (!$results) {
            return $jsonMessage->getEmptyDataMessage();
        }

        foreach ($results as $result) {
            $response = array(
                'id' => $result->getId(),
                'latitude' => $result->getLatitude(),
                'longitude' => $result->getLongitude(),
                'wastetype' => $result->getWastetype(),
                'address' => $result->getAddress(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/trilibs/{tabId}", name="trilibsMany")
     * @param TrilibRepository $trilibRepo
     * @param $tabId
     * @return JsonResponse
     */
    public function indexIdMany(TrilibRepository $trilibRepo, $tabId): JsonResponse
    {
        if($tabId === "null"){
            return new JsonResponse([]);
        }
        
        $response = array();

        $results = $trilibRepo->findMultipleTrilib($tabId);

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any trilib'], Response::HTTP_NOT_FOUND);
        }
        foreach ($results as $result) {
            array_push($response,array(
                'id' => $result->getId(),
                'latitude' => $result->getLatitude(),
                'longitude' => $result->getLongitude(),
                'wastetype' => $result->getWastetype(),
                'address' => $result->getAddress(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
            ));
            
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/trilibs/{tabId}/{limit}", name="trilibsManyLimit")
     * @param TrilibRepository $trilibRepo
     * @param $tabId
     * @param $limit
     * @return JsonResponse
     */
    public function indexIdManyLimit(TrilibRepository $trilibRepo, $tabId,$limit): JsonResponse
    {
        if($tabId == "null"){
            return new JsonResponse([]);
        }

        $response = array();   

        $results = $trilibRepo->findMultipleTrilibLimit($tabId,$limit);

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any trilib'], Response::HTTP_NOT_FOUND);
        }
        foreach ($results as $result) {
            array_push($response,array(
                'id' => $result->getId(),
                'latitude' => $result->getLatitude(),
                'longitude' => $result->getLongitude(),
                'wastetype' => $result->getWastetype(),
                'address' => $result->getAddress(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
            ));
            
        }
        return new JsonResponse($response);
    }
}
