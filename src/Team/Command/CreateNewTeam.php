<?php

namespace Wbits\SoccerTeam\Team\Command;

use Wbits\SoccerTeam\Team\TeamId;
use Wbits\SoccerTeam\Team\TeamInformation;

class CreateNewTeam
{
    private $teamId;
    private $information;

    public function __construct(TeamId $teamId, TeamInformation $information)
    {
        $this->teamId      = $teamId;
        $this->information = $information;
    }

    public function getTeamId(): TeamId
    {
        return $this->teamId;
    }

    public function getInformation(): TeamInformation
    {
        return $this->information;
    }
}
