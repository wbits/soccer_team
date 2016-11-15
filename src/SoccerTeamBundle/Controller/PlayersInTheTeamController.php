<?php

namespace Wbits\SoccerTeam\SoccerTeamBundle\Controller;

use Broadway\ReadModel\RepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Wbits\SoccerTeam\Team\Event\PlayerJoinsTheTeam;

class PlayersInTheTeamController
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function showPlayersAction($teamId)
    {
        /** @var PlayerJoinsTheTeam $readModel */
        $readModel = $this->repository->find($teamId);

        if (null === $readModel) {
            throw new NotFoundHttpException('Your query did not produce any results');
        }

        return new JsonResponse($readModel->serialize());
    }
}
