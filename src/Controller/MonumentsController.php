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

    /**
     * @Route("/monument-all/{id}/{dist}", name="monumentAll4")
     * @param TrilibDistRepository $trilibDist
     * @param ElectricterminalDistRepository $elecDist
     * @param TrimobileDistRepository $trimobileDist
     * @param VelibDistRepository $velibesDist
     * @param $id
     * @param $dist
     * @return JsonResponse
     */
    public function indexIdAll(TrilibDistRepository $trilibDist,
                                   ElectricterminalDistRepository $elecDist,
                                   TrimobileDistRepository $trimobileDist,
                                   VelibDistRepository $velibesDist,
                                   $id, $dist)
    {
        $trilibs = $trilibDist->findTrilibDistByIdMonumentAndDistNoJsoned($id,$dist);
        $elecs = $elecDist->findTerminalDistByIdMonumentAndDistNoJsoned($id,$dist);
        $trimobiles = $trimobileDist->findTrimobileDistByIdMonumentAndDistNoJsoned($id,$dist);
        $velibes = $velibesDist->findTrilibDistByIdMonumentAndDistNoJsoned($id,$dist);

        $response[] = array(
            'trilibs' => $trilibs,
            'borne' => $elecs,
            'timobile' => $trimobiles,
            'velibe' => $velibes,
        );

        return new JsonResponse($response);
    }

    /**
     * @Route("/monument-all-choice/{id}/{distTrilibs}/{distElecs}/{distTrimobile}/{distVelibe}", name="monumentAllChoice")
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
    public function indexIdAllChoice(TrilibDistRepository $trilibDist,
                                         ElectricterminalDistRepository $elecDist,
                                         TrimobileDistRepository $trimobileDist,
                                         VelibDistRepository $velibesDist,
                                         $id, $distTrilibs, $distElecs, $distTrimobile,$distVelibe)
    {
        $trilibs = $trilibDist->findTrilibDistByIdMonumentAndDistNoJsoned($id,$distTrilibs);
        $elecs = $elecDist->findTerminalDistByIdMonumentAndDistNoJsoned($id,$distElecs);
        $trimobiles = $trimobileDist->findTrimobileDistByIdMonumentAndDistNoJsoned($id,$distTrimobile);
        $velibes = $velibesDist->findTrilibDistByIdMonumentAndDistNoJsoned($id,$distVelibe);

        $response[] = array(
            'trilibs' => $trilibs,
            'borne' => $elecs,
            'timobile' => $trimobiles,
            'velibe' => $velibes,
        );

        return new JsonResponse($response);
    }

    /**
     * @Route("/monument-all-dist/{dist}", name="monumentAll")
     * @param MonumentsRepository $monumentsRepo
     * @param TrilibDistRepository $trilibDist
     * @param ElectricterminalDistRepository $elecDist
     * @param TrimobileDistRepository $trimobileDist
     * @param VelibDistRepository $velibesDist
     * @param $dist
     * @return JsonResponse
     */
    public function indexIdAllMonument(MonumentsRepository $monumentsRepo,
                                   TrilibDistRepository $trilibDist,
                                   ElectricterminalDistRepository $elecDist,
                                   TrimobileDistRepository $trimobileDist,
                                   VelibDistRepository $velibesDist,
                                   $dist)
    {   
        $results = $monumentsRepo->findAllMonumentsNoJsoned();
        $response = array();

        foreach ($results as $result) {
            $trilibs = $trilibDist->findTrilibDistByIdMonumentAndDistNoJsoned($result["id"],$dist);
            $terminal = $elecDist->findTerminalDistByIdMonumentAndDistNoJsoned($result["id"],$dist);
            $trimobiles = $trimobileDist->findTrimobileDistByIdMonumentAndDistNoJsoned($result["id"],$dist);
            $velibs = $velibesDist->findTrilibDistByIdMonumentAndDistNoJsoned($result["id"],$dist);

            $response[] = array(
                'id' => $result["id"],
                'name' => $result["name"],
                'longitude' => $result["longitude"],
                'latitude' => $result["latitude"],
                'address' => $result["address"],
                'city' => $result["city"],
                'zipcode' => $result["zipcode"],
                'sport' => $result['sport'],
                'img_url' => $result['img_url'],
                'nbTrilibs' => count($trilibs),
                'nbBornes' =>   count($terminal),
                'nbTrimobiles' => count($trimobiles),
                'nbVelibs' => count($velibs),
                'interets' => [
                    'trimobile'=> $trimobiles,
                    'trilib'=> $trilibs,
                    'terminal'=> $terminal,
                    'velib'=> $velibs
                ]
            );

        }
        return new JsonResponse($response);
    }

    /**
     * @Route("/monument-all-dist/{trilibDistParam}/{borneDistParam}/{trimobileDistParam}/{velibDistParam}", name="monumentAll2")
     * @param MonumentsRepository $monumentsRepo
     * @param TrilibDistRepository $trilibDist
     * @param ElectricterminalDistRepository $elecDist
     * @param TrimobileDistRepository $trimobileDist
     * @param VelibDistRepository $velibesDist
     * @param $trilibDistParam
     * @param $borneDistParam
     * @param $trimobileDistParam
     * @param $velibDistParam
     * @return JsonResponse
     */
    public function indexIdAllMonumentDist(MonumentsRepository $monumentsRepo,
                                   TrilibDistRepository $trilibDist,
                                   ElectricterminalDistRepository $elecDist,
                                   TrimobileDistRepository $trimobileDist,
                                   VelibDistRepository $velibesDist,
                                   $trilibDistParam, $borneDistParam, $trimobileDistParam,$velibDistParam)
    {   
        $results = $monumentsRepo->findAllMonumentsNoJsoned();
        $response = array();

        foreach ($results as $result) {
            $trilibs = $trilibDist->findTrilibDistByIdMonumentAndDistNoJsoned($result["id"],$trilibDistParam);
            $terminal = $elecDist->findTerminalDistByIdMonumentAndDistNoJsoned($result["id"],$borneDistParam);
            $trimobiles = $trimobileDist->findTrimobileDistByIdMonumentAndDistNoJsoned($result["id"],$trimobileDistParam);
            $velibs = $velibesDist->findTrilibDistByIdMonumentAndDistNoJsoned($result["id"],$velibDistParam);

            $response[] = array(
                'id' => $result["id"],
                'name' => $result["name"],
                'longitude' => $result["longitude"],
                'latitude' => $result["latitude"],
                'address' => $result["address"],
                'city' => $result["city"],
                'zipcode' => $result["zipcode"],
                'sport' => $result['sport'],
                'img_url' => $result['img_url'],
                'nbTrilibs' => count($trilibs),
                'nbBornes' =>   count($terminal),
                'nbTrimobiles' => count($trimobiles),
                'nbVelibs' => count($velibs),
                'interets' => [
                    'trimobile'=> $trimobiles,
                    'trilib'=> $trilibs,
                    'terminal'=> $terminal,
                    'velib'=> $velibs
                ]
            );

        }
        return new JsonResponse($response);
    }
}
