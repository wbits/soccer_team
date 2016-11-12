<?php

namespace Wbits\SoccerTeam\ReadModel;

use Broadway\ReadModel\Projector;
use Broadway\ReadModel\RepositoryInterface;
use Wbits\SoccerTeam\Team\Event\MatchWasScheduled;
use Wbits\SoccerTeam\Team\Match\Match;

class MatchesProjector extends Projector
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    protected function applyMatchWasScheduled(MatchWasScheduled $event)
    {
        $readModel = $this->getReadModel((string) $event->getTeamId());

        $match = new Match(
            $event->getMatchId(),
            $event->getOpponent(),
            $event->getKickOff()
        );

        $readModel->addMatch($match);

        $this->repository->save($readModel);
    }

    /**
     * @param string $teamId
     *
     * @return \Broadway\ReadModel\ReadModelInterface|null|Matches
     */
    private function getReadModel(string $teamId)
    {
        $readModel = $this->repository->find($teamId);

        if (null === $readModel) {
            $readModel = new Matches($teamId);
        }

        return $readModel;
    }
}
