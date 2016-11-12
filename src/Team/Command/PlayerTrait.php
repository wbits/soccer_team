<?php

namespace Wbits\SoccerTeam\Team\Command;

use Wbits\SoccerTeam\Team\Player\Player;
use Wbits\SoccerTeam\Team\Player\PlayerInterface;
use Wbits\SoccerTeam\Team\TeamId;

trait PlayerTrait
{
    /**
     * @var TeamId
     */
    private $teamId;

    /**
     * @var Player
     */
    private $player;

    /**
     * @param TeamId          $teamId
     * @param PlayerInterface $player
     */
    public function __construct(TeamId $teamId, PlayerInterface $player)
    {
        $this->teamId = $teamId;
        $this->player = $player;
    }

    /**
     * @return TeamId
     */
    public function getTeamId(): TeamId
    {
        return $this->teamId;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }
}
