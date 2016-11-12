<?php

namespace Wbits\SoccerTeam\Team\Event;

use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\Serializer\PlayerLeavesTheTeamSerializer;
use Wbits\SoccerTeam\Team\Command\PlayerTrait;

class PlayerLeavesTheTeam implements SerializableInterface
{
    use PlayerTrait;

    /**
     * @param array $data
     *
     * @return PlayerLeavesTheTeam
     */
    public static function deserialize(array $data): PlayerLeavesTheTeam
    {
        return PlayerLeavesTheTeamSerializer::deserialize($data);
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return PlayerLeavesTheTeamSerializer::serialize($this);
    }
}
