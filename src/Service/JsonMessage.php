<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonMessage
{
    public function getEmptyDataMessage()
    {
        return new JsonResponse(['message' => 'The response does not contain any data.'], Response::HTTP_NOT_FOUND);
    }
}
