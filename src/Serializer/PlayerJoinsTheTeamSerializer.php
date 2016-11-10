<?php

namespace Wbits\SoccerTeam\Serializer;

use Wbits\SoccerTeam\Team\Event\PlayerJoinsTheTeam;
use Wbits\SoccerTeam\Team\Player\Player;;
use Wbits\SoccerTeam\Team\TeamId;

class PlayerJoinsTheTeamSerializer
{
    /**
     * @param PlayerJoinsTheTeam $playerJoinsTheTeam
     *
     * @return array
     */
    public static function serialize(PlayerJoinsTheTeam $playerJoinsTheTeam): array
    {
        return [
            'teamId'        => (string) $playerJoinsTheTeam->getTeamId(),
            'email_address' => (string) $playerJoinsTheTeam->getPlayer()->getEmail(),
            'nickname'      => (string) $playerJoinsTheTeam->getPlayer()->getNickname(),
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
            new TeamId($data['teamId']),
            new Player($data['email_address'], $data['nickname'])
        );
    }
}

