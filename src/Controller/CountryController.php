<?php

namespace App\Controller;

use App\Repository\CountryRepository;
use App\Service\JsonMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class CountryController extends AbstractController
{
    /**
     * @Route("/country", name="country")
     * @param CountryRepository $countryRepo
     * @param JsonMessage $jsonMessage
     * @return JsonResponse
     */
    public function index(CountryRepository $countryRepo, JsonMessage $jsonMessage): JsonResponse
    {   
        $response = array();
        $results = $countryRepo->findAllCountry();

        $jsonMessage->getEmptyDataMessage($results);

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'name' => $result->getName(),
                'img_url' => $result->getImgUrl(),
            );
        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/country/{id}", name="countryID")
     * @param CountryRepository $countryRepo
     * @param JsonMessage $jsonMessage
     * @param int $id
     * @return JsonResponse
     */
    public function indexId(CountryRepository $countryRepo, JsonMessage $jsonMessage, int $id): JsonResponse
    {
        $response = array();
        $results = $countryRepo->findOneCountry($id);

        $jsonMessage->getEmptyDataMessage($results);

        foreach ($results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'name' => $result->getName(),
                'img_url' => $result->getImgUrl(),
            );
        }
        return new JsonResponse($response);        
    }
}
