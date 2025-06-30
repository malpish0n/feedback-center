<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testEmail()
    {
        $user = new User();
        $user->setEmail('test@example.com');
        $this->assertSame('test@example.com', $user->getEmail());
    }

    public function testRoles()
    {
        $user = new User();
        $user->setRoles(['ROLE_ADMIN']);
        $this->assertContains('ROLE_ADMIN', $user->getRoles());
        $this->assertContains('ROLE_USER', $user->getRoles()); // dodawane automatycznie
    }

    public function testNickname()
    {
        $user = new User();
        $user->setNickname('tester');
        $this->assertSame('tester', $user->getNickname());
    }

}
