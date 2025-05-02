<?php

declare(strict_types=1);

namespace App\Service;

class FeedbackProvider
{
    public function transformDataForTwig(array $feedback): array
    {
        $transformedData = [];
        foreach ($feedback as $entry) {
            $transformedData['feedback'][] = [
                'title' => $entry->getTitle(),
                'link' => 'feedback/' . $entry->getId(),
            ];
        }

        return $transformedData;
    }   
}
