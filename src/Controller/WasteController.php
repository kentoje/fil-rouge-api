<?php

namespace App\Controller;

use App\Repository\WasteRepository;
use App\Service\JsonMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class WasteController extends AbstractController
{
    /**
     * @Route("/waste", name="wastes")
     * @param WasteRepository $wastesRepo
     * @param JsonMessage $jsonMessage
     * @return JsonResponse
     */
    public function index(WasteRepository $wastesRepo, JsonMessage $jsonMessage): JsonResponse
    {
        $response = array();
        $results = $wastesRepo->findAllWastes();

        if (!$results) {
            return $jsonMessage->getEmptyDataMessage();
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
     * @param JsonMessage $jsonMessage
     * @param int $id
     * @return JsonResponse
     */
    public function indexId(WasteRepository $waste, JsonMessage $jsonMessage, int $id): JsonResponse
    {
        $response = array();
        $results = $waste->findOneWaste($id);

        if (!$results) {
            return $jsonMessage->getEmptyDataMessage();
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
