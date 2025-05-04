<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false)]
    private ?HomePageContent $homePageContent = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHomePageContent(): ?HomePageContent
    {
        return $this->homePageContent;
    }

    public function setHomePageContent(?HomePageContent $homePageContent): static
    {
        $this->homePageContent = $homePageContent;

        return $this;
    }
}
