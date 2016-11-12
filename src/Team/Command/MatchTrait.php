<?php

namespace Wbits\SoccerTeam\Team\Command;

use Wbits\SoccerTeam\Team\Match\Match;
use Wbits\SoccerTeam\Team\TeamId;

trait MatchTrait
{
    /**
     * @var TeamId
     */
    private $teamId;

    /**
     * @var Match
     */
    private $match;

    /**
     * @param TeamId $teamId
     * @param Match  $match
     */
    public function __construct(TeamId $teamId, Match $match)
    {
        $this->teamId = $teamId;
        $this->match  = $match;
    }

    /**
     * @return TeamId
     */
    public function getTeamId(): TeamId
    {
        return $this->teamId;
    }

    /**
     * @return Match
     */
    public function getMatch(): Match
    {
        return $this->match;
    }
}
