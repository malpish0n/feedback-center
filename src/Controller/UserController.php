<?php

namespace App\Controller;

use App\Service\UserService;
use App\Formatter\ApiResponseFormatter;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



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

    #[Route('/users/{id}', name: 'app_user_show', requirements: ['id' => '\d+'])]
    public function show(int $id)
    {

    }

    #[Route('/users/create', name: 'create_user', methods: ['POST'])]
    public function createUser(Request $request, UserService $userService): JsonResponse
    {
    $data = jon_decode($request->getContent(), true);

    if (!isset($data['email'], $data['password'])) {
        return new JsonResponse(['error' => 'Missing fields'], 400);
    }

    try {
        $userService->createUser($data);
    } catch (\RuntimeException $e) {
        return new JsonResponse(['error' => $e->getMessage()], 400);
    }

    return new JsonResponse(['status' => 'User created'], 201);
    }

    #[Route('/users/{id}', name: 'update_user', methods: ['PUT'])]
    public function updateUser(int $id,
    Request $request,
    UserRepository $userRepository,
    EntityManagerInterface $em,
    UserPasswordHasherInterface $passwordHasher
    ): JsonResponse {
    $user = $userRepository->find($id);
    dd($user);
    
    if (!$user) {
        return new JsonResponse(['error' => 'User not found'], 404);
    }

    $data = json_decode($request->getContent(), true);

    if (isset($data['email'])) {
        $user->setEmail($data['email']);
    }

    if (isset($data['password'])) {
        $hashedPassword = $passwordHasher->hashPassword($user, $data['password']);
        $user->setPassword($hashedPassword);
    }

    $em->flush();
    dd('reached');
    return new JsonResponse(['status' => 'User updated'], 200);

    }



    #[Route('/users/{id}', name: 'delete_user', methods: ['DELETE'])]
    public function deleteUser(int $id, UserRepository $userRepository, EntityManagerInterface $em): JsonResponse
    {
        $user = $userRepository->find($id);
    
        if (!$user) {
            return new JsonResponse(['error' => 'User not found'], 404);
        }
    
        $em->remove($user);
        $em->flush();
    
        return new JsonResponse(['status' => 'User deleted'], 200); // <-- TO BYŁO WYMAGANE
    }

}
