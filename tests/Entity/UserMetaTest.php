<?php

namespace App\Tests\Entity;

use App\Entity\User;
use App\Entity\UserMeta;
use PHPUnit\Framework\TestCase;

class UserMetaTest extends TestCase
{
    public function testKey()
    {
        $meta = new UserMeta();
        $meta->setKey('theme');
        $this->assertSame('theme', $meta->getKey());
    }

    public function testValue()
    {
        $meta = new UserMeta();
        $meta->setValue('dark');
        $this->assertSame('dark', $meta->getValue());
    }

    public function testAppUser()
    {
        $user = new User();
        $meta = new UserMeta();
        $meta->setAppUser($user);
        $this->assertSame($user, $meta->getAppUser());
    }
    
    public function testAddUserMeta()
    {
        $user = new User();
        $userMeta = new UserMeta();
        $userMeta->setKey('color');
        $userMeta->setValue('blue');

        $user->addUserMeta($userMeta);

        $this->assertCount(1, $user->getUserMetas());
        $this->assertSame($user, $userMeta->getAppUser());
    }

    public function testRemoveUserMeta()
    {
        $user = new User();
        $userMeta = new UserMeta();
        $user->addUserMeta($userMeta);

        $user->removeUserMeta($userMeta);

        $this->assertCount(0, $user->getUserMetas());
        $this->assertNull($userMeta->getAppUser());
    }
}
