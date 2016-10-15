<?php

namespace Wbits\SoccerTeam\Team\Command;

use Wbits\SoccerTeam\Team\TeamId;
use Wbits\SoccerTeam\Team\TeamId;

class StartNewSeason
{
    private $teamId;
    private $information;

    public function __construct(TeamId $teamId, TeamId $information)
    {
        $this->teamId      = $teamId;
        $this->information = $information;
    }

    public function getTeamId(): TeamId
    {
        return $this->teamId;
    }

    public function getInformation(): TeamId
    {
        return $this->information;
    }

    public function toArray(): array
    {
        return [
            'team_id'    => (string) $this->teamId,
            'team_name'  => $this->information->getClubName(),
            'season'    => $this->information->getSeason(),
        ];
    }
}
