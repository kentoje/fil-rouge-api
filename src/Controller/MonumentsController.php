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
    public function indexId(MonumentsRepository $monumentsRepo, $id)
    {
        $result = $monumentsRepo->findOneMonument($id);

        return $result;
    }

    /**
     * @Route("/monument-dist-all/{id}/{dist}", name="monumentDistAll")
     * @param TrilibDistRepository $trilibDist
     * @param ElectricterminalDistRepository $elecDist
     * @param TrimobileDistRepository $trimobileDist
     * @param VelibDistRepository $velibesDist
     * @param $id
     * @param $dist
     * @return JsonResponse
     */
    public function indexIdDistAll(TrilibDistRepository $trilibDist,
                                   ElectricterminalDistRepository $elecDist,
                                   TrimobileDistRepository $trimobileDist,
                                   VelibDistRepository $velibesDist,
                                   $id, $dist)
    {
        $trilibs = $trilibDist->countTrilibDistByIdMonumentAndDist($id,$dist)[0]["nb"];
        $elecs = $elecDist->countTerminalDistByIdMonumentAndDist($id,$dist)[0]["nb"];
        $trimobiles = $trimobileDist->countTrimobileDistByIdMonumentAndDist($id,$dist)[0]["nb"];
        $velibes = $velibesDist->countTrilibDistByIdMonumentAndDist($id,$dist)[0]["nb"];

        $response[] = array(
            'nbTrilibs' => $trilibs,
            'nbBorne' => $elecs,
            'nbTrimobile' => $trimobiles,
            'nbVelibe' => $velibes,
        );

        return new JsonResponse($response);
    }

    /**
     * @Route("/monument-dist-all-choice/{id}/{distTrilibs}/{distElecs}/{distTrimobile}/{distVelibe}", name="monumentDistAllChoice")
     * @param TrilibDistRepository $trilibDist
     * @param ElectricterminalDistRepository $elecDist
     * @param TrimobileDistRepository $trimobileDist
     * @param VelibDistRepository $velibesDist
     * @param $id
     * @param $distTrilibs
     * @param $distElecs
     * @param $distTrimobile
     * @param $distVelibe
     * @return JsonResponse
     */
    public function indexIdDistAllChoice(TrilibDistRepository $trilibDist,
                                   ElectricterminalDistRepository $elecDist,
                                   TrimobileDistRepository $trimobileDist,
                                   VelibDistRepository $velibesDist,
                                   $id, $distTrilibs, $distElecs, $distTrimobile,$distVelibe)
    {
        $trilibs = $trilibDist->countTrilibDistByIdMonumentAndDist($id,$distTrilibs)[0]["nb"];
        $elecs = $elecDist->countTerminalDistByIdMonumentAndDist($id,$distElecs)[0]["nb"];
        $trimobiles = $trimobileDist->countTrimobileDistByIdMonumentAndDist($id,$distTrimobile)[0]["nb"];
        $velibes = $velibesDist->countTrilibDistByIdMonumentAndDist($id,$distVelibe)[0]["nb"];

        $response[] = array(
            'nbTrilibs' => $trilibs,
            'nbBorne' => $elecs,
            'nbTrimobile' => $trimobiles,
            'nbVelibe' => $velibes,
        );

        return new JsonResponse($response);
    }
}
