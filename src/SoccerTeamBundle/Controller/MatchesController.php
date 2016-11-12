<?php

namespace Wbits\SoccerTeam\SoccerTeamBundle\Controller;

use Broadway\ReadModel\RepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Wbits\SoccerTeam\ReadModel\Matches;

class MatchesController
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function showMatchesAction($teamId)
    {
        /** @var Matches $readModel */
        $readModel = $this->repository->find($teamId);

        if (null === $readModel) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($readModel->serialize());
    }
}
