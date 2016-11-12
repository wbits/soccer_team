<?php

namespace Wbits\SoccerTeam\Serializer;

use Wbits\SoccerTeam\Team\Event\PlayerLeavesTheTeam;
use Wbits\SoccerTeam\Team\Player\Player;
use Wbits\SoccerTeam\Team\Property\Email;
use Wbits\SoccerTeam\Team\Property\Nickname;
use Wbits\SoccerTeam\Team\TeamId;

class PlayerLeavesTheTeamSerializer
{
    /**
     * @param PlayerLeavesTheTeam $event
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
     * @return PlayerLeavesTheTeam
     */
    public static function deserialize(array $data): PlayerLeavesTheTeam
    {
        return new PlayerLeavesTheTeam(
            new TeamId($data['team_id']),
            PlayerSerializer::deserialize($data['player'])
        );
    }
}
