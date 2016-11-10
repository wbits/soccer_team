<?php

namespace Wbits\SoccerTeam\Team\Command;

use Wbits\SoccerTeam\Team\TeamId;

class AddPlayer
{
    private $teamId;
    private $emailAddress;
    private $nickname;

    /**
     * @param TeamId $teamId
     * @param string $emailAddress
     * @param string $nickname
     */
    public function __construct(TeamId $teamId, string $emailAddress, string $nickname)
    {
        $this->teamId       = $teamId;
        $this->emailAddress = $emailAddress;
        $this->nickname     = $nickname;
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

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }
}
