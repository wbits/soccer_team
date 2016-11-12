<?php

namespace Wbits\SoccerTeam\SoccerTeamBundle;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Wbits\SoccerTeam\SoccerTeamBundle\Exception\ValidationException;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception  = $event->getException();
        $message    = ['message' => $exception->getMessage()];
        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

        if ($exception instanceof ValidationException) {
            $message = $exception->hasErrors() ? $exception->getErrors() : $message;
        }

        if ($exception instanceof HttpExceptionInterface) {
            $statusCode = $exception->getStatusCode();
        }

        $response = new JsonResponse($message);
        $response->setStatusCode($statusCode);

        $event->setResponse($response);
    }
}
