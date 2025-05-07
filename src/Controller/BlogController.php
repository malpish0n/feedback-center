<?php
declare(strict_types=1);

namespace App\Controller;

use App\Repository\FeedbackRepository;
use App\Service\FeedbackProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BlogController extends AbstractController
{
    public function __construct(
        private FeedbackRepository $feedbackRepository,
        private FeedbackProvider $feedbackProvider
    ) {
    }

    #[Route('/feedback', name: 'blog-feedback')]
    public function showFeedback(): Response
    {
        $feedback = $this->feedbackRepository->findAll();
        $parameters = [];

        if ($feedback) {
            $parameters = $this->feedbackProvider->transformDataForTwig($feedback);
        }

        return $this->render('feedback/feedback.html.twig', $parameters);
    }
}
