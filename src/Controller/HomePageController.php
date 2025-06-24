<?php

namespace App\Controller;

use App\Repository\HomePageContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PostRepository;


class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
public function index(PostRepository $postRepo): Response
{
    $posts = $postRepo->findBy([], ['id' => 'DESC']);

    return $this->render('home_page/index.html.twig', [
        'posts' => $posts,
    ]);
}

}
