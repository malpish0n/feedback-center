<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Group;
use App\Entity\UserMeta;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nickname = null;

    #[ORM\ManyToMany(targetEntity: Group::class, inversedBy: 'users')]
    #[ORM\JoinTable(name: 'user_group')]
    private Collection $groups;

    /**
     * @var Collection<int, UserMeta>
     */
    #[ORM\OneToMany(targetEntity: UserMeta::class, mappedBy: 'appUser')]
    private Collection $userMetas;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->userMetas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function eraseCredentials(): void
    {
    
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): static
    {
        $this->nickname = $nickname;
        return $this;
    }

    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(Group $group): static
    {
        if (!$this->groups->contains($group)) {
            $this->groups->add($group);
            $group->addUser($this);
        }
        return $this;
    }

    public function removeGroup(Group $group): static
    {
        if ($this->groups->removeElement($group)) {
            $group->removeUser($this);
        }
        return $this;
    }

    /**
     * Metoda zwracająca identyfikator użytkownika dla Symfony Security
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @return Collection<int, UserMeta>
     */
    public function getUserMetas(): Collection
    {
        return $this->userMetas;
    }

    public function addUserMeta(UserMeta $userMeta): static
    {
        if (!$this->userMetas->contains($userMeta)) {
            $this->userMetas->add($userMeta);
            $userMeta->setAppUser($this);
        }

        return $this;
    }

    public function removeUserMeta(UserMeta $userMeta): static
    {
        if ($this->userMetas->removeElement($userMeta)) {
            // set the owning side to null (unless already changed)
            if ($userMeta->getAppUser() === $this) {
                $userMeta->setAppUser(null);
            }
        }

        return $this;
    }
}
