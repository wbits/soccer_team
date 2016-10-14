<?php

namespace Wbits\SoccerTeam\Player\Command;

use Wbits\SoccerTeam\Player\Property\Name;
use Wbits\SoccerTeam\Player\Property\PlayerId;

class JoinTheTeam
{
    private $playerId;
    private $name;

    public function __construct(PlayerId $playerId, Name $name)
    {
        $this->playerId = $playerId;
        $this->name     = $name;
    }

    public function getPlayerId(): PlayerId
    {
        return $this->playerId;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return [
            'id'        => (string) $this->getPlayerId(),
            'firstName' => $this->getName()->getFirstName(),
            'lastName'  => $this->getName()->getLastName(),
        ];
    }
}
