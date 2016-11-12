<?php

namespace Wbits\SoccerTeam\Team\TeamAction;

use Wbits\SoccerTeam\Team\Event\PlayerSubmitsAvailabilityForMatch;
use Wbits\SoccerTeam\Team\Player\SubmittedAvailabilityForMatch;

trait PlayerActionsTrait
{
    public function addPlayerWhoSubmitsAvailabilityForMatch(SubmittedAvailabilityForMatch $player, string $matchId)
    {
        $match = $this->getSeason()->findMatch($matchId);
        $event = new PlayerSubmitsAvailabilityForMatch($this->teamId, $player);
        $event->setMatch($match);

        $this->apply($event);
    }

    public function applyPlayerSubmitsAvailabilityForMatch(PlayerSubmitsAvailabilityForMatch $event)
    {
        $match = $event->getMatch();
        $match->addPlayerAvailable($event->getPlayer());
    }
}
