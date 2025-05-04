<?php

namespace App\Controller;

use App\Repository\HomePageContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomePageController extends AbstractController
{
    #[Route('/home/page', name: 'app_home_page')]
    public function index(HomePageContentRepository $repository): Response
    {
        $items = $repository->findAll();

        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
            'items' => $items,
        ]);
    }

    #[Route('/home/page/{id}/edit', name: 'home_page_edit')]
    public function edit(int $id): Response
    {
    // Tutaj będzie formularz edycji
    return new Response("Edytuj rekord o ID: $id");
    }

    #[Route('/home/page/{id}/delete', name: 'home_page_delete')]
    public function delete(int $id): Response
    {
    // Tutaj będzie usuwanie rekordu
    return new Response("Usuń rekord o ID: $id");
    }

}


