<?php

namespace Wbits\SoccerTeam\Team\Command;

use Broadway\CommandHandling\CommandHandler;
use Wbits\SoccerTeam\Team\Team;
use Wbits\SoccerTeam\Team\TeamId;

class TeamCommandHandler extends CommandHandler
{
    private $repository;

    /**
     * @param TeamRepository $repository
     */
    public function __construct(TeamRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CreateNewTeam $command
     */
    public function handleCreateNewTeam(CreateNewTeam $command)
    {
        $team = Team::create(
            $command->getTeamId(),
            $command->getInformation()
        );

        $this->repository->save($team);
    }

    /**
     * @param AddPlayer $command
     */
    public function handleAddPlayer(AddPlayer $command)
    {
        $team = $this->loadTeam($command->getTeamId());
        $team->addPlayerToTheTeam($command->getPlayer());

        $this->repository->save($team);
    }

    /**
     * @param RemovePlayer $command
     */
    public function handleRemovePlayer(RemovePlayer $command)
    {
        $team = $this->loadTeam($command->getTeamId());
        $team->removePlayerFromTheTeam($command->getPlayer());

        $this->repository->save($team);
    }

    /**
     * @param ScheduleMatch $command
     */
    public function handleScheduleMatch(ScheduleMatch $command)
    {
        $team = $this->loadTeam($command->getTeamId());
        $team->scheduleMatch($command->getMatch());

        $this->repository->save($team);
    }

    /**
     * @param TeamId $teamId
     *
     * @return Team
     */
    private function loadTeam(TeamId $teamId): Team
    {
        return $this->repository->load($teamId);
    }
}
