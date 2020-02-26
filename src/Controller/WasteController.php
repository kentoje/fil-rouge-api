<?php

namespace App\Controller;

use App\Repository\WasteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WasteController extends AbstractController
{
    /**
     * @Route("/waste", name="wastes")
     * @param WasteRepository $wastesRepo
     * @return JsonResponse
     */
    public function index(WasteRepository $wastesRepo): JsonResponse
    {
        $response = array();
        $results = $wastesRepo->findAllWastes();

        if (!$results) {
            return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
        }

        foreach ( $results as $result) {
            $response[] = array(
                'id' => $result->getId(),
                'name' => $result->getName(),
                'degradation_time' => $result->getDegradationTime(),
                'trash_color' => $result->getTrashColor(),
                'img_url' => $result->getImgUrl(),
            );
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/waste/{id}", name="waste")
     * @param WasteRepository $waste
     * @param $id
     * @return JsonResponse
     */
    public function indexId(WasteRepository $waste, int $id): JsonResponse
    {
        $response = array();
        $results = $waste->findOneWaste($id);

        if (!$results) {
            return new JsonResponse(['message' => 'This id does not match any waste'], Response::HTTP_NOT_FOUND);
        }

        foreach ($results as $result) {
            $response = array(
                'id' => $result->getId(),
                'name' => $result->getName(),
                'degradation_time' => $result->getDegradationTime(),
                'trash_color' => $result->getTrashColor(),
                'img_url' => $result->getImgUrl(),
            );
        }
        return new JsonResponse($response);
    }
}
