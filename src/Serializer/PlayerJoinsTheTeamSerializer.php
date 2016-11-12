<?php

namespace Wbits\SoccerTeam\Serializer;

use Wbits\SoccerTeam\Team\Event\PlayerJoinsTheTeam;
use Wbits\SoccerTeam\Team\Player\Player;
use Wbits\SoccerTeam\Team\TeamId;

class PlayerJoinsTheTeamSerializer
{
    /**
     * @param PlayerJoinsTheTeam $event
     *
     * @return array
     */
    public static function serialize($event): array
    {
        return [
            'team_id' => (string) $event->getTeamId(),
            'player'  => PlayerSerializer::serialize($event->getPlayer()),
        ];
    }

    /**
     * @param array $data
     *
     * @return PlayerJoinsTheTeam
     */
    public static function deserialize(array $data): PlayerJoinsTheTeam
    {
        return new PlayerJoinsTheTeam(
            new TeamId($data['team_id']),
            PlayerSerializer::deserialize($data['player'])
        );
    }
}
