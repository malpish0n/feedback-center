<?php

namespace App\Controller;

use App\Formatter\ApiResponseFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
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
}
