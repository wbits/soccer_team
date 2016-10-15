<?php

namespace Wbits\SoccerTeam\Team\Command;

use Wbits\SoccerTeam\Team\TeamId;
use Wbits\SoccerTeam\Team\TeamInformation;

class StartNewSeason
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

    public function toArray(): array
    {
        return [
            'team_id'    => (string) $this->teamId,
            'team_name'  => $this->information->getClub(),
            'season'    => $this->information->getSeason(),
        ];
    }
}
