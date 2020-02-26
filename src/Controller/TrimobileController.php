<?php

namespace App\Controller;

use App\Repository\TrimobileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TrimobileController extends AbstractController
{
    /**
     * @Route("/trimobile", name="trimobiles")
     * @param TrimobileRepository $trimobileRepo
     * @return JsonResponse
     */
    public function index(TrimobileRepository $trimobileRepo): JsonResponse
    {
        $response = array();
        $results = $trimobileRepo->findAllTrimobiles();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
                'address' => $result->getAddress(),
                'schedule' => $result->getSchedule(),
                'longitude' => $result->getLongitude(),
                'latitude' => $result->getLatitude(),
                'timeRange' => $result->getTimeRange(),
                'addressSupplement' => $result->getAddressSupplement(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/trimobile/{id}", name="trimobile")
     * @param TrimobileRepository $trimobileRepo
     * @param $id
     * @return JsonResponse
     */
    public function indexId(TrimobileRepository $trimobileRepo, int $id): JsonResponse
    {
        $response = array();
        $results = $trimobileRepo->findOneTrimobile($id);

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any tri mobile'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response = array(
                'id' => $result->getId(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
                'address' => $result->getAddress(),
                'schedule' => $result->getSchedule(),
                'longitude' => $result->getLongitude(),
                'latitude' => $result->getLatitude(),
                'timeRange' => $result->getTimeRange(),
                'addressSupplement' => $result->getAddressSupplement(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/trimobiles/{tabId}", name="trimobileMany")
     * @param TrimobileRepository $trimobileRepo
     * @param $tabId
     * @return JsonResponse
     */
    public function indexIdMany(TrimobileRepository $trimobileRepo, $tabId): JsonResponse
    {
        if($tabId === "null"){
            return new JsonResponse([]);
        }
        $response = array(); 

        $results = $trimobileRepo->findMultipleTrimobile($tabId);

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any tri mobile'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            array_push($response,array(
                'id' => $result->getId(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
                'address' => $result->getAddress(),
                'schedule' => $result->getSchedule(),
                'longitude' => $result->getLongitude(),
                'latitude' => $result->getLatitude(),
                'timeRange' => $result->getTimeRange(),
                'addressSupplement' => $result->getAddressSupplement(),
            ));
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/trimobiles/{tabId}/{limit}", name="trimobileManyLimit")
     * @param TrimobileRepository $trimobileRepo
     * @param $tabId
     * @param $limit
     * @return JsonResponse
     */
    public function indexIdManyLimit(TrimobileRepository $trimobileRepo, $tabId, $limit): JsonResponse
    {
        if($tabId === "null"){
            return new JsonResponse([]);
        }

        $response = array(); 

        $results = $trimobileRepo->findMultipleTrimobilewithLimit($tabId,$limit);

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any tri mobile'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            array_push($response,array(
                'id' => $result->getId(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
                'address' => $result->getAddress(),
                'schedule' => $result->getSchedule(),
                'longitude' => $result->getLongitude(),
                'latitude' => $result->getLatitude(),
                'timeRange' => $result->getTimeRange(),
                'addressSupplement' => $result->getAddressSupplement(),
            ));
        }
        return new JsonResponse($response);
    }
}
