<?php

namespace App\Tests\Behat;

use App\Entity\Group;
use App\Entity\User;
use App\Entity\UserMeta;
use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Step\Then;
use Behat\Step\When;


class EntityContext implements Context
{
    private ?Group $group = null;
    private ?User $user = null;
    private ?UserMeta $userMeta = null;

    /** @Given I have a new Group entity */
    public function iHaveANewGroupEntity(): void
    {
        $this->group = new Group();
    }

    /** @Given I have a new User entity */
    public function iHaveANewUserEntity(): void
    {
        $this->user = new User();
    }

    /** @Given I have a new UserMeta entity */
    public function iHaveANewUserMetaEntity(): void
    {
        $this->userMeta = new UserMeta();
    }

    /** @Given I have a new UserMeta entity with key :key and value :value */
    public function iHaveANewUserMetaEntityWithKeyAndValue(string $key, string $value): void
    {
        $this->userMeta = new UserMeta();
        $this->userMeta->setKey($key);
        $this->userMeta->setValue($value);
    }

    /** @When I add User to Group */
    public function iAddUserToGroup(): void
    {
        $this->group->addUser($this->user);
    }

    /** @Then Group should contain User */
    public function groupShouldContainUser(): void
    {
        Assert::assertTrue($this->group->getUsers()->contains($this->user));
    }

    /** @When I remove User from Group */
    public function iRemoveUserFromGroup(): void
    {
        $this->group->removeUser($this->user);
    }

    /** @Then Group should NOT contain User */
    public function groupShouldNotContainUser(): void
    {
        Assert::assertFalse($this->group->getUsers()->contains($this->user));
    }

    /** @When I set key to :key */
    public function iSetKeyTo(string $key): void
    {
        $this->userMeta->setKey($key);
    }

    /** @Then UserMeta key should be :key */
    public function usermetaKeyShouldBe(string $key): void
    {
        Assert::assertSame($key, $this->userMeta->getKey());
    }

    /** @When I set value to :value */
    public function iSetValueTo(string $value): void
    {
        $this->userMeta->setValue($value);
    }

    /** @Then UserMeta value should be :value */
    public function usermetaValueShouldBe(string $value): void
    {
        Assert::assertSame($value, $this->userMeta->getValue());
    }

    /** @When I set UserMeta's user to User */
    public function iSetUsermetasUserToUser(): void
    {
        $this->userMeta->setAppUser($this->user);
    }

    /** @Then UserMeta's user should be User */
    public function usermetasUserShouldBeUser(): void
    {
        Assert::assertSame($this->user, $this->userMeta->getAppUser());
    }

    /** @When I add UserMeta to User */
    public function iAddUsermetaToUser(): void
    {
        $this->user->addUserMeta($this->userMeta);
    }

    /** @Then User should have :count UserMeta */
    public function userShouldHaveUsermetas(int $count): void
    {
        Assert::assertCount($count, $this->user->getUserMetas());
    }

    /** @When I remove UserMeta from User */
    public function iRemoveUsermetaFromUser(): void
    {
        $this->user->removeUserMeta($this->userMeta);
    }

    /** @Then UserMeta's user should be null */
    public function usermetasUserShouldBeNull(): void
    {
        Assert::assertNull($this->userMeta->getAppUser());
    }

    /** @When I set User email to :email */
    public function iSetUserEmailTo(string $email): void
    {
        $this->user->setEmail($email);
    }

    /** @Then User email should be :email */
    public function userEmailShouldBe(string $email): void
    {
        Assert::assertSame($email, $this->user->getEmail());
    }

    /** @Then User roles should contain :role */
    public function userRolesShouldContain(string $role): void
    {
        Assert::assertContains($role, $this->user->getRoles());
    }

    /** @When I set User nickname to :nickname */
    public function iSetUserNicknameTo(string $nickname): void
    {
        $this->user->setNickname($nickname);
    }

    /** @Then User nickname should be :nickname */
    public function userNicknameShouldBe(string $nickname): void
    {
        Assert::assertSame($nickname, $this->user->getNickname());
    }

    /** @When I set User roles to :roles */
    public function iSetUserRolesTo(string $roles): void
    {
        $rolesArray = array_map('trim', explode(',', $roles));
        if (!in_array('ROLE_USER', $rolesArray, true)) {
            $rolesArray[] = 'ROLE_USER';
        }
        $this->user->setRoles($rolesArray);
    }

    /** @When I set Group name to :name */
    public function iSetGroupNameTo(string $name): void
    {
        $this->group->setName($name);
    }

    /** @Then Group name should be :name */
    public function groupNameShouldBe(string $name): void
    {
        Assert::assertSame($name, $this->group->getName());
    }
}
