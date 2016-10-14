<?php

namespace Wbits\SoccerTeam\Team\Command;

use Wbits\SoccerTeam\Team\TeamId;
use Wbits\SoccerTeam\Player\Player;

class AddPlayer
{
    private $teamId;
    private $player;

    public function __construct(TeamId $teamId, Player $player)
    {
        $this->teamId = $teamId;
        $this->player = $player;
    }

    public function getTeamId(): TeamId
    {
        return $this->teamId;
    }

    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function toArray()
    {
        $name = $this->player->getName();

        return [
            'team_id'    => (string) $this->teamId,
            'first_name' => $name->getFirstName(),
            'last_name'  => $name->getLastName(),
        ];
    }
}
