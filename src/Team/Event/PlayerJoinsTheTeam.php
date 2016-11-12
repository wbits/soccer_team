<?php

namespace Wbits\SoccerTeam\Team\Event;

use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\Serializer\PlayerJoinsTheTeamSerializer;
use Wbits\SoccerTeam\Team\Command\PlayerTrait;

class PlayerJoinsTheTeam implements SerializableInterface
{
    use PlayerTrait;

    /**
     * @param array $data
     *
     * @return PlayerJoinsTheTeam
     */
    public static function deserialize(array $data): PlayerJoinsTheTeam
    {
        return PlayerJoinsTheTeamSerializer::deserialize($data);
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return PlayerJoinsTheTeamSerializer::serialize($this);
    }
}
