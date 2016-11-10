<?php

namespace Wbits\SoccerTeam\Team\Command;

use Wbits\SoccerTeam\Team\Player\Player;
use Wbits\SoccerTeam\Team\TeamId;

class AddPlayer
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
     * @param TeamId $teamId
     * @param Player $player
     */
    public function __construct(TeamId $teamId, Player $player)
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
