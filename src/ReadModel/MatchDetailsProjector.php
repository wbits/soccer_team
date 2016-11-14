<?php

namespace Wbits\SoccerTeam\ReadModel;

use Broadway\ReadModel\Projector;
use Broadway\ReadModel\RepositoryInterface;
use Wbits\SoccerTeam\Team\Event\AvailabilityForMatchWasSubmitted;
use Wbits\SoccerTeam\Team\Event\MatchWasScheduled;

class MatchDetailsProjector extends Projector
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    protected function applyMatchWasScheduled(MatchWasScheduled $event)
    {
        $match = $event->getMatch();

        $readModel = $this->getReadModel((string) $match->getMatchId());
        $readModel->setOpponent($match->getOpponent());
        $readModel->setKickoff($match->getKickoff());

        $this->repository->save($readModel);
    }

    protected function applyAvailabilityForMatchWasSubmitted(AvailabilityForMatchWasSubmitted $event)
    {
        $readModel = $this->getReadModel((string) $event->getMatch()->getMatchId());
        $readModel->addPlayerWhoSubmittedAvailability($event->getPlayer());

        $this->repository->save($readModel);
    }

    /**
     * @param string $matchId
     *
     * @return \Broadway\ReadModel\ReadModelInterface|null|MatchDetails
     */
    private function getReadModel(string $matchId)
    {
        $readModel = $this->repository->find($matchId);

        if (null === $readModel) {
            $readModel = new MatchDetails($matchId);
        }

        return $readModel;
    }
}
