<?php
declare(strict_types=1);
namespace App\Controller;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\ArticleProvider;


class BlogController extends AbstractController
{

    public function __construct(
        private ArticleRepository $articleRepository,
        private ArticleProvider $articleProvider
    )
    {  
    }


    #[Route('/articles',name:'blog-articles')]
    public function showArticles(): Response
    {
        $articles = $this->articleRepository->findAll();
        $parameters = [];
        if ($articles) {
            $parameters = $this->articleProvider->transformDataForTwig($articles);
        }
        return $this->render('articles/articles.html.twig', $parameters);
    }
}

