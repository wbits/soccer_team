<?php

namespace Wbits\SoccerTeam\Player;

use Broadway\CommandHandling\CommandHandler;
use Wbits\SoccerTeam\Player\Command\JoinTheTeam;

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
     * @param JoinTheTeam $command
     */
    protected function handleJoinTheTeam(JoinTheTeam $command)
    {
        $player = Player::joinTheTeam(
            $command->getPlayerId(),
            $command->getName()
        );

        $this->repository->save($player);
    }
}
