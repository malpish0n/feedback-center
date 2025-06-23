<?php

namespace App\Controller;

use App\Repository\HomePageContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(HomePageContentRepository $repository): Response
    {
        $items = $repository->findAll();

        return $this->render('home_page/index.html.twig', [
            'items' => $items,
        ]);
    }
}
