<?php

namespace Wbits\SoccerTeam\Team\Event;

use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\Serializer\TeamWasCreatedSerializer;
use Wbits\SoccerTeam\Team\Command\CreateTeamTrait;

class TeamWasCreated implements SerializableInterface
{
    use CreateTeamTrait;

    /**
     * @param array $data
     *
     * @return TeamWasCreated
     */
    public static function deserialize(array $data): TeamWasCreated
    {
        return TeamWasCreatedSerializer::deserialize($data);
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return TeamWasCreatedSerializer::serialize($this);
    }
}
