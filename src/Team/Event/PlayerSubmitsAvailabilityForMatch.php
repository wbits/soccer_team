<?php

namespace Wbits\SoccerTeam\Team\Event;

use Wbits\SoccerTeam\Team\Command\PlayerTrait;
use Wbits\SoccerTeam\Team\Match\Match;

class PlayerSubmitsAvailabilityForMatch
{
    use PlayerTrait;

    /**
     * @var Match
     */
    private $match;

    /**
     * @return Match
     */
    public function getMatch(): Match
    {
        return $this->match;
    }

    /**
     * @param Match $match
     */
    public function setMatch(Match $match)
    {
        $this->match = $match;
    }
}
