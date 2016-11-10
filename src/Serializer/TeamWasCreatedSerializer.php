<?php

namespace Wbits\SoccerTeam\Serializer;

use Wbits\SoccerTeam\Team\Event\TeamWasCreated;
use Wbits\SoccerTeam\Team\TeamId;
use Wbits\SoccerTeam\Team\TeamInformation;

class TeamWasCreatedSerializer
{
    public static function serialize(TeamWasCreated $event): array
    {
        return [
            'team_id' => (string) $event->getTeamId(),
            'club'    => $event->getInformation()->getClub(),
            'team'    => $event->getInformation()->getTeam(),
            'season'  => $event->getInformation()->getSeason(),
        ];
    }

    public static function deserialize(array $data): TeamWasCreated
    {
        return new TeamWasCreated(
            new TeamId($data['team_id']),
            new TeamInformation(
                $data['club'],
                $data['team'],
                $data['season']
            )
        );
    }
}
