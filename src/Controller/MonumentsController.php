<?php

namespace App\Controller;

use App\Repository\MonumentsRepository;
use App\Service\JsonMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class MonumentsController extends AbstractController
{
    /**
     * @Route("/monument", name="monuments")
     * @param MonumentsRepository $monumentsRepo
     * @param JsonMessage $jsonMessage
     * @return JsonResponse
     */
    public function index(MonumentsRepository $monumentsRepo, JsonMessage $jsonMessage): JsonResponse
    {
        $response = array();
        $results = $monumentsRepo->findAllMonuments();

        $jsonMessage->getEmptyDataMessage($results);

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'name' => $result->getName(),
                'longitude' => $result->getLongitude(),
                'latitude' => $result->getLatitude(),
                'address' => $result->getAddress(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
                'sport' => $result->getSport(),
                'img_url' => $result->getImgUrl(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/monument/{id}", name="monument")
     * @param MonumentsRepository $monumentsRepo
     * @param JsonMessage $jsonMessage
     * @param int $id
     * @return JsonResponse
     */
    public function indexId(MonumentsRepository $monumentsRepo, JsonMessage $jsonMessage, int $id): JsonResponse
    {
        $response = array();
        $results = $monumentsRepo->findOneMonument($id);

        $jsonMessage->getEmptyDataMessage($results);

        foreach ($results as $result) {
            $response = array(
                'id' => $result->getId(),
                'name' => $result->getName(),
                'longitude' => $result->getLongitude(),
                'latitude' => $result->getLatitude(),
                'address' => $result->getAddress(),
                'city' => $result->getCity(),
                'zipcode' => $result->getZipcode(),
                'sport' => $result->getSport(),
                'img_url' => $result->getImgUrl(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/monument-dist-all/{id}/{dist}", name="monumentDistAll")
     * @param MonumentsRepository $monumentsRepo
     * @param JsonMessage $jsonMessage
     * @param int $id
     * @param int $dist
     * @return JsonResponse
     */
    public function indexIdDistAll(MonumentsRepository $monumentsRepo, JsonMessage $jsonMessage, int $id, int $dist): JsonResponse
    {
        $response = $monumentsRepo->getCountOfInterestsByIdAndDist($id, $dist);

        $jsonMessage->getEmptyDataMessage($response);

        $flattenArray = array();
        $multiDimensionArray = array($response);

        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($multiDimensionArray));
        foreach ($iterator as $key => $value) {
            $flattenArray[$key] = (int) $value;
        }

        return new JsonResponse($flattenArray);
    }

    /**
     * @Route("/monument-dist-all-choice/{id}/{distTrilibs}/{distElecs}/{distTrimobile}/{distVelib}", name="monumentDistAllChoice")
     * @param MonumentsRepository $monumentsRepo
     * @param JsonMessage $jsonMessage
     * @param int $id
     * @param int $distTrilibs
     * @param int $distElecs
     * @param int $distTrimobile
     * @param int $distVelib
     * @return JsonResponse
     */
    public function indexIdDistAllChoice(MonumentsRepository $monumentsRepo, JsonMessage $jsonMessage, int $id, int $distTrilibs, int $distElecs, int $distTrimobile, int $distVelib): JsonResponse
    {
        $response = $monumentsRepo->getCountOfInterestsByIdAndMultipleDist($id, $distTrilibs, $distElecs, $distTrimobile, $distVelib);

        $jsonMessage->getEmptyDataMessage($response);

        $flattenArray = array();
        $multiDimensionArray = array($response);

        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($multiDimensionArray));
        foreach ($iterator as $key => $value) {
            $flattenArray[$key] = (int) $value;
        }

        return new JsonResponse($flattenArray);
    }

    /**
     * @Route("/monument-all/{id}/{dist}", name="monumentAll4")
     * @param MonumentsRepository $monumentsRepo
     * @param JsonMessage $jsonMessage
     * @param int $id
     * @param int $dist
     * @return JsonResponse
     */
    public function indexIdAll(MonumentsRepository $monumentsRepo, JsonMessage $jsonMessage, int $id, int $dist): JsonResponse
    {
        $response = $monumentsRepo->getInterestsByIdAndDist($id, $dist);

        $jsonMessage->getEmptyDataMessage($response);

        return new JsonResponse($response);
    }

    /**
     * @Route("/monument-all-choice/{id}/{distTrilibs}/{distElecs}/{distTrimobile}/{distVelib}", name="monumentAllChoice")
     * @param MonumentsRepository $monumentsRepo
     * @param JsonMessage $jsonMessage
     * @param int $id
     * @param int $distTrilibs
     * @param int $distElecs
     * @param int $distTrimobile
     * @param int $distVelib
     * @return JsonResponse
     */
    public function indexIdAllChoice(MonumentsRepository $monumentsRepo, JsonMessage $jsonMessage, int $id, int $distTrilibs, int $distElecs, int $distTrimobile, int $distVelib): JsonResponse
    {

        $response = $monumentsRepo->getInterestsByIdAndMultipleDist($id, $distTrilibs, $distElecs, $distTrimobile, $distVelib);

        $jsonMessage->getEmptyDataMessage($response);

        return new JsonResponse($response);
    }

    /**
     * @Route("/monument-all-dist/{dist}", name="monumentAll")
     * @param MonumentsRepository $monumentsRepo
     * @param JsonMessage $jsonMessage
     * @param int $dist
     * @return JsonResponse
     */
    public function indexIdAllMonument(MonumentsRepository $monumentsRepo, JsonMessage $jsonMessage, int $dist): JsonResponse
    {
        $response = $monumentsRepo->findAllMonumentsAndTheirInterests($dist);

        $jsonMessage->getEmptyDataMessage($response);

        return new JsonResponse($response);
    }

    /**
     * @Route("/monument-all-dist/{trilibDistParam}/{elecsDistParam}/{trimobileDistParam}/{velibDistParam}", name="monumentAll2")
     * @param MonumentsRepository $monumentsRepo
     * @param JsonMessage $jsonMessage
     * @param int $trilibDistParam
     * @param int $elecsDistParam
     * @param int $trimobileDistParam
     * @param int $velibDistParam
     * @return JsonResponse
     */
    public function indexIdAllMonumentDist(MonumentsRepository $monumentsRepo, JsonMessage $jsonMessage, int $trilibDistParam, int $elecsDistParam, int $trimobileDistParam, int $velibDistParam): JsonResponse
    {
        $response = $monumentsRepo->findAllMonumentsAndTheirInterestsMultipleDist($trilibDistParam, $elecsDistParam, $trimobileDistParam, $velibDistParam);

        $jsonMessage->getEmptyDataMessage($response);
        
        return new JsonResponse($response);
    }
}
