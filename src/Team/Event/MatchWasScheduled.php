<?php

namespace Wbits\SoccerTeam\Team\Event;

use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\Serializer\MatchWasScheduledSerializer;
use Wbits\SoccerTeam\Team\Command\MatchTrait;

class MatchWasScheduled implements SerializableInterface
{
    use MatchTrait;

    /**
     * @param array $data
     *
     * @return MatchWasScheduled
     */
    public static function deserialize(array $data): MatchWasScheduled
    {
        return MatchWasScheduledSerializer::deserialize($data);
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return MatchWasScheduledSerializer::serialize($this);
    }
}
