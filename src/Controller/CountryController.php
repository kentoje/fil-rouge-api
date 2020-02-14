<?php

namespace App\Controller;

use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends AbstractController
{
    /**
     * @Route("/country", name="country")
     * @param CountryRepository $countryRepo
     * @return JsonResponse
     */
    public function index(CountryRepository $countryRepo): JsonResponse
    {   
        $response = array();

        $results = $countryRepo->findAllCountry();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'name' => $result->getName(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/country/{id}", name="countryID")
     * @param CountryRepository $countryRepo
     * @param $id
     * @return JsonResponse
     */
    public function indexId(CountryRepository $countryRepo,int $id): JsonResponse
    {
        $results = $countryRepo->findOneCountry($id);

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'name' => $result->getName(),
            );
        }
        return new JsonResponse($response);

        return $results;
    }
}
