<?php

namespace App\Controller;

use App\Repository\MonumentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MonumentsController extends AbstractController
{
    /**
     * @Route("/monument", name="monuments")
     * @param MonumentsRepository $monumentsRepo
     * @return JsonResponse
     */
    public function index(MonumentsRepository $monumentsRepo): JsonResponse
    {
        $results = $monumentsRepo->findAllMonuments();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

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
     * @param $id
     * @return JsonResponse
     */
    public function indexId(MonumentsRepository $monumentsRepo, int $id): JsonResponse
    {
        $results = $monumentsRepo->findOneMonument($id);

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any monument'], Response::HTTP_NOT_FOUND);
        }

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
     * @param int $id
     * @param int $dist
     * @return JsonResponse
     */
    public function indexIdDistAll(MonumentsRepository $monumentsRepo, int $id, int $dist): JsonResponse
    {
        $response = $monumentsRepo->getCountOfInterestsByIdAndDist($id, $dist);

        if (!$response) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

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
     * @param int $id
     * @param int $distTrilibs
     * @param int $distElecs
     * @param int $distTrimobile
     * @param int $distVelib
     * @return JsonResponse
     */
    public function indexIdDistAllChoice(MonumentsRepository $monumentsRepo, int $id, int $distTrilibs, int $distElecs, int $distTrimobile, int $distVelib): JsonResponse
    {
        $response = $monumentsRepo->getCountOfInterestsByIdAndMultipleDist($id, $distTrilibs, $distElecs, $distTrimobile, $distVelib);

        if (!$response) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

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
     * @param int $id
     * @param int $dist
     * @return JsonResponse
     */
    public function indexIdAll(MonumentsRepository $monumentsRepo, int $id, int $dist): JsonResponse
    {
        $response = $monumentsRepo->getInterestsByIdAndDist($id, $dist);

        if (!$response) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/monument-all-choice/{id}/{distTrilibs}/{distElecs}/{distTrimobile}/{distVelib}", name="monumentAllChoice")
     * @param MonumentsRepository $monumentsRepo
     * @param int $id
     * @param int $distTrilibs
     * @param int $distElecs
     * @param int $distTrimobile
     * @param int $distVelib
     * @return JsonResponse
     */
    public function indexIdAllChoice(MonumentsRepository $monumentsRepo, int $id, int $distTrilibs, int $distElecs, int $distTrimobile, int $distVelib): JsonResponse
    {

        $response = $monumentsRepo->getInterestsByIdAndMultipleDist($id, $distTrilibs, $distElecs, $distTrimobile, $distVelib);

        if (!$response) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/monument-all-dist/{dist}", name="monumentAll")
     * @param MonumentsRepository $monumentsRepo
     * @param $dist
     * @return JsonResponse
     */
    public function indexIdAllMonument(MonumentsRepository $monumentsRepo, int $dist): JsonResponse
    {
        $response = $monumentsRepo->findAllMonumentsAndTheirInterests($dist);

        if (!$response) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/monument-all-dist/{trilibDistParam}/{elecsDistParam}/{trimobileDistParam}/{velibDistParam}", name="monumentAll2")
     * @param MonumentsRepository $monumentsRepo
     * @param $trilibDistParam
     * @param $elecsDistParam
     * @param $trimobileDistParam
     * @param $velibDistParam
     * @return JsonResponse
     */
    public function indexIdAllMonumentDist(MonumentsRepository $monumentsRepo, int $trilibDistParam, int $elecsDistParam, int $trimobileDistParam, int $velibDistParam): JsonResponse
    {
        $response = $monumentsRepo->findAllMonumentsAndTheirInterestsMultipleDist($trilibDistParam, $elecsDistParam, $trimobileDistParam, $velibDistParam);

        if (!$response) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }
        
        return new JsonResponse($response);
    }
}
