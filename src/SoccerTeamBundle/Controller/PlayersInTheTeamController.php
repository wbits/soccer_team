<?php

namespace Wbits\SoccerTeam\SoccerTeamBundle\Controller;

use Broadway\ReadModel\RepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Wbits\SoccerTeam\Team\Event\PlayerJoinsTheTeam;

class PlayersInTheTeamController
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function showPlayersAction(Request $request, $teamId)
    {
        /** @var PlayerJoinsTheTeam $readModel */
        $readModel = $this->repository->find($teamId);

        if (null === $readModel) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($readModel->serialize());
    }
}
