<?php

namespace App\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ExceptionListener
{
    private LoggerInterface $logger;
    private ParameterBagInterface $params;

    public function __construct(LoggerInterface $logger, ParameterBagInterface $params)
    {
        $this->logger = $logger;
        $this->params = $params;
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        $this->logger->error($exception->getMessage(), ['exception' => $exception]);

        $statusCode = 500;
        $message = 'Internal Server Error';

        if ($exception instanceof HttpExceptionInterface) {
            $statusCode = $exception->getStatusCode();
            $message = $exception->getMessage() ?: $message;
        } elseif ($exception->getMessage()) {
            $message = $exception->getMessage();
        }

        $responseData = [
            'error' => [
                'message' => $message,
                'code' => $statusCode,
            ],
        ];


        if ($this->params->get('kernel.environment') === 'dev') {
            $responseData['error']['trace'] = $exception->getTraceAsString();
        }

        $response = new JsonResponse($responseData, $statusCode);

        $event->setResponse($response);
    }
}
