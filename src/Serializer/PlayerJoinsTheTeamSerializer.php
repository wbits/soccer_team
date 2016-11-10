<?php

namespace Wbits\SoccerTeam\Serializer;

use Wbits\SoccerTeam\Team\Event\PlayerJoinsTheTeam;
use Wbits\SoccerTeam\Team\Player\Player;;
use Wbits\SoccerTeam\Team\Property\Email;
use Wbits\SoccerTeam\Team\Property\Nickname;
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
            'team_id'        => (string) $playerJoinsTheTeam->getTeamId(),
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
            new TeamId($data['team_id']),
            new Player(
                new Email($data['email_address']),
                new Nickname($data['nickname'])
            )
        );
    }
}

