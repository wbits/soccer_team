<?php

namespace Wbits\SoccerTeam\SoccerTeamBundle\Controller;

use Broadway\ReadModel\RepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Wbits\SoccerTeam\ReadModel\MatchDetails;
use Wbits\SoccerTeam\ReadModel\Matches;

class MatchesController
{
    private $matchesRepository;
    private $matchDetailsRepository;

    public function __construct(RepositoryInterface $matchesRepository, RepositoryInterface $matchDetailsRepository)
    {
        $this->matchesRepository      = $matchesRepository;
        $this->matchDetailsRepository = $matchDetailsRepository;
    }

    public function showMatchesAction($teamId)
    {
        /** @var Matches $readModel */
        $readModel = $this->matchesRepository->find($teamId);

        if (null === $readModel) {
            throw new NotFoundHttpException('Your query did not produce any results');
        }

        return new JsonResponse($readModel->serialize());
    }

    public function showMatchDetailsAction($matchId)
    {
        /** @var MatchDetails $matchDetails */
        $matchDetails = $this->matchDetailsRepository->find($matchId);

        if (null === $matchDetails) {
            throw new NotFoundHttpException('Your query did not produce any results');
        }

        return new JsonResponse($matchDetails->serialize());
    }
}
