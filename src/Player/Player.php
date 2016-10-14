<?php

namespace Wbits\SoccerTeam\Player;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Wbits\SoccerTeam\Player\Event\PlayerJoinsTheTeam;
use Wbits\SoccerTeam\Player\Property\Name;
use Wbits\SoccerTeam\Player\Property\PlayerId;

class Player extends EventSourcedAggregateRoot
{
    private $playerId;
    private $name;

    public static function joinTheTeam(PlayerId $memberId, Name $name): Player
    {
        $teamMember = new Player();
        $teamMember->join($memberId, $name);

        return $teamMember;
    }

    private function join(PlayerId $memberId, Name $name)
    {
        $this->apply(new PlayerJoinsTheTeam($memberId, $name));
    }

    public function applyPlayerJoinsTheTeam(PlayerJoinsTheTeam $event)
    {
        $this->playerId = $event->getPlayerId();
        $this->name     = $event->getName();
    }

    /**
     * @return string
     */
    public function getAggregateRootId(): string
    {
        return $this->playerId;
    }
}
