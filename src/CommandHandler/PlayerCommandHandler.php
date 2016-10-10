<?php

namespace Wbits\SoccerTeam\CommandHandler;

use Broadway\CommandHandling\CommandHandler;
use Wbits\SoccerTeam\Command\PlayerJoinsTheTeamCommand;
use Wbits\SoccerTeam\EventSourcingRepository\PlayerRepository;
use Wbits\SoccerTeam\Role\Player;

class PlayerCommandHandler extends CommandHandler
{
    /**
     * @var PlayerRepository
     */
    private $repository;

    /**
     * @param PlayerRepository $repository
     */
    public function __construct(PlayerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param PlayerJoinsTheTeamCommand $command
     */
    protected function handlePlayerJoinsTheTeamCommand(PlayerJoinsTheTeamCommand $command)
    {
        $player = Player::joinsTheTeam(
            $command->getPlayerId(),
            $command->getFirstName(),
            $command->getLastName()
        );

        $this->repository->save($player);
    }
}
