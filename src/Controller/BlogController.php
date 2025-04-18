<?php
declare(strict_types=1);
namespace App\Controller;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BlogController extends AbstractController
{

    public function __construct(
        private ArticleRepository $articleRepository
    )
    {  
    }


    #[Route('/main-page',name:'main_page')]
    public function mainPage(): Response
    {
        $articles = $this->articleRepository->findAll();
        dump($articles);
        return new Response(print_r($articles,true));
    }
}

