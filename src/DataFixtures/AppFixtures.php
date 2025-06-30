<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Group;
use App\Entity\UserMeta;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $adminGroup = new Group();
        $adminGroup->setName('Administrators');

        $userGroup = new Group();
        $userGroup->setName('Users');

        $manager->persist($adminGroup);
        $manager->persist($userGroup);

        $admin = new User();
        $admin->setEmail('admin@gmail.com');
        $admin->setNickname('Admin');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->hasher->hashPassword($admin, 'admin'));
        $admin->addGroup($adminGroup);
        $adminGroup->getUsers()->add($admin);

        $user = new User();
        $user->setEmail('user@gmail.com');
        $user->setNickname('User');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->hasher->hashPassword($user, 'user'));
        $user->addGroup($userGroup);
        $userGroup->getUsers()->add($user);

        $manager->persist($admin);
        $manager->persist($user);

        $adminMeta = new UserMeta();
        $adminMeta->setAppUser($admin);
        $adminMeta->setKey('dashboard_theme');
        $adminMeta->setValue('dark');
        $manager->persist($adminMeta);

        $userMeta = new UserMeta();
        $userMeta->setAppUser($user);
        $userMeta->setKey('notifications');
        $userMeta->setValue('enabled');
        $manager->persist($userMeta);

        $manager->flush();
    }
}
