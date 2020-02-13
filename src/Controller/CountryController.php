<?php

namespace App\Controller;

use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class CountryController extends AbstractController
{
    /**
     * @Route("/country", name="country")
     * @param CountryRepository $countryRepo
     * @return JsonResponse
     */
    public function index(CountryRepository $countryRepo)
    {
        $results = $countryRepo->findAllCountry();

        return $results;
    }

    /**
     * @Route("/country/{id}", name="countryID")
     * @param CountryRepository $countryRepo
     * @param $id
     * @return JsonResponse
     */
    public function indexId(CountryRepository $countryRepo,int $id)
    {
        $results = $countryRepo->findOneCountry($id);

        return $results;
    }
}
