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
        if ($this->userRepository->userExists($data['email'])) {
            throw new \RuntimeException('User already exists');
        }

        $user = new User();
        $user->setEmail($data['email']);
        $user->setPassword(
            $this->passwordHasher->hashPassword($user, $data['password'])
        );

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
