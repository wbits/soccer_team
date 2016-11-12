<?php

namespace Wbits\SoccerTeam\Serializer;

use Wbits\SoccerTeam\Team\Event\MatchWasScheduled;
use Wbits\SoccerTeam\Team\TeamId;

class MatchWasScheduledSerializer
{
    public static function serialize(MatchWasScheduled $event): array
    {
        return [
            'team_id' => (string) $event->getTeamId(),
            'match'   => MatchSerializer::serialize($event->getMatch()),
        ];
    }

    public static function deserialize(array $data): MatchWasScheduled
    {
        return new MatchWasScheduled(
            new TeamId($data['team_id']),
            MatchSerializer::deserialize($data['match'])
        );
    }
}
