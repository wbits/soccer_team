<?php

namespace Wbits\SoccerTeam\Team\Command;

use Broadway\CommandHandling\CommandHandler;
use Wbits\SoccerTeam\Team\Team;

class TeamCommandHandler extends CommandHandler
{
    private $repository;

    public function __construct(TeamRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handleCreateNewTeam(CreateNewTeam $command)
    {
        $team = Team::create(
            $command->getTeamId(),
            $command->getInformation()
        );

        $this->repository->save($team);
    }

    public function handleAddPlayer(AddPlayer $command)
    {
        /** @var Team $team */
        $team = $this->repository->load($command->getTeamId());
        $team->addPlayer($command->getPlayer());

        $this->repository->save($team);
    }
}
