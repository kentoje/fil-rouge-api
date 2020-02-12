<?php

namespace App\Controller;

use App\Repository\ElectricterminalDistRepository;
use App\Repository\MonumentsRepository;
use App\Repository\TrilibDistRepository;
use App\Repository\TrimobileDistRepository;
use App\Repository\VelibDistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class MonumentsController extends AbstractController
{
    /**
     * @Route("/monument", name="monuments")
     * @param MonumentsRepository $monumentsRepo
     * @return JsonResponse
     */
    public function index(MonumentsRepository $monumentsRepo)
    {
        $results = $monumentsRepo->findAllMonuments();

        return $results;
    }

    /**
     * @Route("/monument/{id}", name="monument")
     * @param MonumentsRepository $monumentsRepo
     * @param $id
     * @return JsonResponse
     */
    public function indexId(MonumentsRepository $monumentsRepo, int $id)
    {
        $result = $monumentsRepo->findOneMonument($id);

        return $result;
    }

    /**
     * @Route("/monument-dist-all/{id}/{dist}", name="monumentDistAll")
     * @param MonumentsRepository $monumentsRepo
     * @param int $id
     * @param int $dist
     * @return JsonResponse
     */
    public function indexIdDistAll(MonumentsRepository $monumentsRepo, int $id, int $dist)
    {
        $result = $monumentsRepo->getCountOfInterestsByIdAndDist($id, $dist);

        return $result;
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
    public function indexIdDistAllChoice(MonumentsRepository $monumentsRepo, int $id, int $distTrilibs, int $distElecs, int $distTrimobile, int $distVelib)
    {
        $result = $monumentsRepo->getCountOfInterestsByIdAndMultipleDist($id, $distTrilibs, $distElecs, $distTrimobile, $distVelib);

        return $result;
    }

    /**
     * @Route("/monument-all/{id}/{dist}", name="monumentAll4")
     * @param MonumentsRepository $monumentsRepo
     * @param int $id
     * @param int $dist
     * @return JsonResponse
     */
    public function indexIdAll(MonumentsRepository $monumentsRepo, int $id, int $dist)
    {
        $result = $monumentsRepo->getInterestsByIdAndDist($id, $dist);

        return $result;
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
    public function indexIdAllChoice(MonumentsRepository $monumentsRepo, int $id, int $distTrilibs, int $distElecs, int $distTrimobile, int $distVelib)
    {

        $result = $monumentsRepo->getInterestsByIdAndMultipleDist($id, $distTrilibs, $distElecs, $distTrimobile, $distVelib);

        return $result;
    }

    /**
     * @Route("/monument-all-dist/{dist}", name="monumentAll")
     * @param MonumentsRepository $monumentsRepo
     * @param $dist
     * @return JsonResponse
     */
    public function indexIdAllMonument(MonumentsRepository $monumentsRepo, int $dist)
    {
        $result = $monumentsRepo->findAllMonumentsAndTheirInterests($dist);

        return $result;
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
    public function indexIdAllMonumentDist(MonumentsRepository $monumentsRepo, int $trilibDistParam, int $elecsDistParam, int $trimobileDistParam, int $velibDistParam)
    {
        $result = $monumentsRepo->findAllMonumentsAndTheirInterestsMultipleDist($trilibDistParam, $elecsDistParam, $trimobileDistParam, $velibDistParam);

        return $result;
    }
}
