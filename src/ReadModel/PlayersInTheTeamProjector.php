<?php

namespace Wbits\SoccerTeam\ReadModel;

use Broadway\ReadModel\Projector;
use Broadway\ReadModel\RepositoryInterface;
use Wbits\SoccerTeam\Team\Event\PlayerJoinsTheTeam;
use Wbits\SoccerTeam\Team\Event\PlayerLeavesTheTeam;
use Wbits\SoccerTeam\Team\Player\Player;

class PlayersInTheTeamProjector extends Projector
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    protected function applyPlayerJoinsTheTeam(PlayerJoinsTheTeam $event)
    {
        $readModel = $this->getReadModel((string)$event->getTeamId());

        $readModel->addPlayer(Player::create(
            $event->getEmailAddress(),
            $event->getFirstName(),
            $event->getLastName()
        ));

        $this->repository->save($readModel);
    }

    protected function applyPlayerLeavesTheTeam(PlayerLeavesTheTeam $event)
    {
        $readModel = $this->getReadModel((string)$event->getTeamId());
        $readModel->removePlayerByEmailAddress($event->getEmailAddress());

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
