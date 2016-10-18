<?php

namespace Wbits\SoccerTeam\Team\Command;

use Wbits\SoccerTeam\Team\Match\Opponent;
use Wbits\SoccerTeam\Team\TeamId;

class ScheduleMatch
{
    /**
     * @var TeamId
     */
    private $teamId;

    /**
     * @var int
     */
    private $matchId;

    /**
     * @var \DateTime
     */
    private $kickOff;

    /**
     * @var Opponent
     */
    private $opponent;

    /**
     * @param TeamId $teamId
     * @param int $matchId
     * @param \DateTime $kickOff
     * @param Opponent $opponent
     */
    public function __construct(TeamId $teamId, int $matchId, \DateTime $kickOff, Opponent $opponent)
    {
        $this->teamId   = $teamId;
        $this->matchId  = $matchId;
        $this->kickOff  = $kickOff;
        $this->opponent = $opponent;
    }

    /**
     * @return TeamId
     */
    public function getTeamId(): TeamId
    {
        return $this->teamId;
    }

    /**
     * @return int
     */
    public function getMatchId(): int
    {
        return $this->matchId;
    }

    /**
     * @return \DateTime
     */
    public function getKickOff(): \DateTime
    {
        return $this->kickOff;
    }

    /**
     * @return Opponent
     */
    public function getOpponent(): Opponent
    {
        return $this->opponent;
    }
}
