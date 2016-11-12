<?php

namespace Wbits\SoccerTeam\ReadModel;

use Broadway\ReadModel\Projector;
use Broadway\ReadModel\RepositoryInterface;
use Wbits\SoccerTeam\Team\Event\PlayerJoinsTheTeam;
use Wbits\SoccerTeam\Team\Event\PlayerLeavesTheTeam;

class PlayersInTheTeamProjector extends Projector
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    protected function applyPlayerJoinsTheTeam(PlayerJoinsTheTeam $event)
    {
        $readModel = $this->getReadModel((string) $event->getTeamId());
        $readModel->addPlayer($event->getPlayer());

        $this->repository->save($readModel);
    }

    protected function applyPlayerLeavesTheTeam(PlayerLeavesTheTeam $event)
    {
        $readModel = $this->getReadModel((string) $event->getTeamId());
        $readModel->removePlayer($event->getPlayer());

        $this->repository->save($readModel);
    }

    /**
     * @param string $teamId
     *
     * @return \Broadway\ReadModel\ReadModelInterface|null|PlayersInTheTeam
     */
    private function getReadModel(string $teamId)
    {
        $readModel = $this->repository->find($teamId);

        if (null === $readModel) {
            $readModel = new PlayersInTheTeam($teamId);
        }

        return $readModel;
    }
}
