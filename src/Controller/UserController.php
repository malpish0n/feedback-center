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

    #[Route('/users', name: 'app_user')]
    public function index(): Response
    {

    }

    #[Route('/users/{id}', name: 'app_user_show')]
    public function show(int $id)
    {

    }

    #[Route('/users', name: 'create_user', methods: ['POST'])]
    public function createUser(Request $request): Response
    {
        dd(request->request->all());
    }

    #[Route('/users', name: 'update_user')]
    public function updateUser(int $id): JsonResponse
    {

    }

    #[Route('/users', name: 'delete_user')]
    public function deleteUser(int $id): JsonResponse
    {

    }

}
