<?php

namespace Wbits\SoccerTeam\Team\Command;

class SubmitAvailabilityForMatch
{
    use PlayerTrait;

    private $matchId;

    /**
     * @return mixed
     */
    public function getMatchId()
    {
        return $this->matchId;
    }

    /**
     * @param mixed $matchId
     *
     * @return SubmitAvailabilityForMatch
     */
    public function setMatchId($matchId): SubmitAvailabilityForMatch
    {
        $this->matchId = $matchId;

        return $this;
    }
}
