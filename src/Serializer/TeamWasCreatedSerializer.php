<?php

namespace Wbits\SoccerTeam\Serializer;

use Wbits\SoccerTeam\Team\Event\TeamWasCreated;
use Wbits\SoccerTeam\Team\TeamId;

class TeamWasCreatedSerializer
{
    public static function serialize(TeamWasCreated $event): array
    {
        return [
            'team_id'   => (string) $event->getTeamId(),
            'team_info' => TeamInformationSerializer::serialize($event->getInformation()),
        ];
    }

    public static function deserialize(array $data): TeamWasCreated
    {
        return new TeamWasCreated(
            new TeamId($data['team_id']),
            TeamInformationSerializer::deserialize($data['team_info'])
        );
    }
}
