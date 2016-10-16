<?php

namespace Wbits\SoccerTeam\Team\Command;

use Wbits\SoccerTeam\Team\TeamId;

class RemovePlayer
{
    private $teamId;
    private $emailAddress;

    /**
     * @param TeamId $teamId
     * @param string $emailAddress
     */
    public function __construct(TeamId $teamId, string $emailAddress)
    {
        $this->teamId       = $teamId;
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return TeamId
     */
    public function getTeamId(): TeamId
    {
        return $this->teamId;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }
}
