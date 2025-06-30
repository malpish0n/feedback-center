<?php

namespace App\Tests\Entity;

use App\Entity\Group;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class GroupTest extends TestCase
{
    public function testAddUser()
    {
        $group = new Group();
        $user = new User();

        $group->addUser($user);
        $this->assertTrue($group->getUsers()->contains($user));
    }

    public function testRemoveUser()
    {
        $group = new Group();
        $user = new User();

        $group->addUser($user);
        $group->removeUser($user);
        $this->assertFalse($group->getUsers()->contains($user));
    }
}
