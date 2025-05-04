<?php

namespace App\Controller;

use App\Repository\HomePageContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/homepage')]
final class HomePageApiController extends AbstractController
{
    #[Route('', name: 'api_homepage_index', methods: ['GET'])]
    public function index(HomePageContentRepository $repository): JsonResponse
    {
        $items = $repository->findAll();

        return $this->json($items);
    }
}
