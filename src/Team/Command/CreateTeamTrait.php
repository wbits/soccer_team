<?php

namespace Wbits\SoccerTeam\Team\Command;

use Wbits\SoccerTeam\Team\TeamId;
use Wbits\SoccerTeam\Team\TeamInformation;

trait CreateTeamTrait
{
    /**
     * @var TeamId
     */
    private $teamId;

    /**
     * @var TeamInformation
     */
    private $information;

    /**
     * @param TeamId $teamId
     * @param TeamInformation $information
     */
    public function __construct(TeamId $teamId, TeamInformation $information)
    {
        $this->teamId      = $teamId;
        $this->information = $information;
    }

    /**
     * @return TeamId
     */
    public function getTeamId(): TeamId
    {
        return $this->teamId;
    }

    /**
     * @return TeamInformation
     */
    public function getInformation(): TeamInformation
    {
        return $this->information;
    }
}
