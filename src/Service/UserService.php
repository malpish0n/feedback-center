<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $passwordHasher,
    ) {}

    public function createUser(array $data): User
{
    $user = new User();
    $user->setEmail($data['email']);
    $user->setNickname($data['nickname']);
    $user->setRoles(['ROLE_USER']);
    $hashedPassword = $this->passwordHasher->hashPassword($user, $data['password']);
    $user->setPassword($hashedPassword);

    $this->entityManager->persist($user);
    $this->entityManager->flush();

    return $user;
    }

}