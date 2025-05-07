<?php

namespace App\Controller;

use App\Repository\HomePageContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\HomePageContent;
use App\Form\HomePageContentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class HomePageController extends AbstractController
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
    public function edit(
        int $id,
        HomePageContentRepository $repository,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $item = $repository->find($id);
    
        if (!$item) {
            throw $this->createNotFoundException("Nie znaleziono rekordu o ID $id");
        }
    
        $form = $this->createForm(HomePageContentType::class, $item);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
    
            return $this->redirectToRoute('app_home_page');
        }
    
        return $this->render('home_page/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    

    #[Route('/home/page/{id}/delete', name: 'home_page_delete')]
    public function delete(
        int $id,
        HomePageContentRepository $repository,
        EntityManagerInterface $em
    ): Response {
        $item = $repository->find($id);
    
        if (!$item) {
            throw $this->createNotFoundException("Nie znaleziono rekordu o ID $id");
        }
    
        $em->remove($item);
        $em->flush();
    
        return $this->redirectToRoute('app_home_page');
    }
}


