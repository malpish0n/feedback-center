<?php

namespace App\Controller;

use App\Formatter\ApiResponseFormatter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/users/show', name: 'app_user', methods: ['GET'])]
public function showUser(ApiResponseFormatter $formatter): JsonResponse
{
    $currentUser = $this->getUser();

    return $formatter
        ->setData([
            'user_id' => $currentUser->getId(),
            'user_email' => $currentUser->getEmail(),
        ])
        ->getResponse();
}

    
