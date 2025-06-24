<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;
use App\Form\PostType;



class PostController extends AbstractController
{
    #[Route('/post/add', name: 'post_add')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
    $post = new Post();
    $form = $this->createForm(PostType::class, $post);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($post);
        $em->flush();
        return $this->redirectToRoute('app_home_page'); // albo strona z listą postów
    }

    return $this->render('post/add.html.twig', [
    'form' => $form->createView(),
    ]);

}

}
