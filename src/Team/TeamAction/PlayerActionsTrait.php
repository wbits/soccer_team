<?php

namespace Wbits\SoccerTeam\Team\TeamAction;

use Wbits\SoccerTeam\Team\Event\AvailabilityForMatchWasSubmitted;
use Wbits\SoccerTeam\Team\Player\Player;

trait PlayerActionsTrait
{
    /**
     * @param Player $player
     * @param string $matchId
     */
    public function submitAvailabilityForMatch(Player $player, string $matchId)
    {
        $match = $this->getSeason()->findMatch($matchId);
        $event = new AvailabilityForMatchWasSubmitted($this->teamId, $player);
        $event->setMatch($match);

        $this->apply($event);
    }

    public function applyAvailabilityForMatchWasSubmitted(AvailabilityForMatchWasSubmitted $event)
    {
        $match = $event->getMatch();
        $match->addPlayerWhoSubmittedAvailabilityForMatch($event->getPlayer());
    }
}
