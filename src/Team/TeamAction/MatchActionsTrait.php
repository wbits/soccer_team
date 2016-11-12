<?php

namespace Wbits\SoccerTeam\Team\TeamAction;

use Wbits\SoccerTeam\Team\Event\MatchWasScheduled;
use Wbits\SoccerTeam\Team\Match\Match;
use Wbits\SoccerTeam\Team\Match\Season;

trait MatchActionsTrait
{
    /**
     * @var Season
     */
    private $season;

    /**
     * @param Match $match
     */
    public function scheduleMatch(Match $match)
    {
        $this->getSeason()->validateScheduledMatch($match);

        $this->apply(new MatchWasScheduled($this->teamId, $match));
    }

    /**
     * @param MatchWasScheduled $event
     */
    public function applyMatchWasScheduled(MatchWasScheduled $event)
    {
        $match = $event->getMatch();

        $this->getSeason()->set($match->getMatchId(), $match);
    }

    /**
     * @return Season
     */
    private function getSeason(): Season
    {
        $this->season = $this->season ?? new Season();

        return $this->season;
    }
}
