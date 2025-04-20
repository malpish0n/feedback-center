<?php

declare(strict_types=1);

namespace App\Service;

class ArticleProvider
{
    public function transformDataForTwig(array $articles): array
    {
        $transformedData = [];
        foreach ($articles as $article) {
            $transformedData['articles'][] = [
                'title' => $article->getTitle(),
                'link' => 'article/' . $article->getId(),
            ];
        }
        
        return $transformedData;
    }
}