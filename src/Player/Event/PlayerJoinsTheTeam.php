<?php

namespace Wbits\SoccerTeam\Player\Event;

use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\Player\Property\Name;
use Wbits\SoccerTeam\Player\Property\PlayerId;

class PlayerJoinsTheTeam implements SerializableInterface
{
    private $playerId;
    private $name;

    public function __construct(PlayerId $memberId, Name $name)
    {
        $this->playerId = $memberId;
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

    public static function deserialize(array $data): PlayerJoinsTheTeam
    {
        $memberId = new PlayerId($data['playerId']);
        $name     = new Name($data['firstName'], $data['lastName']);

        return new self($memberId, $name);
    }

    public function serialize(): array
    {
        return [
            'playerId'  => (string)$this->playerId,
            'firstName' => $this->name->getFirstName(),
            'lastName'  => $this->name->getLastName(),
        ];
    }
}
