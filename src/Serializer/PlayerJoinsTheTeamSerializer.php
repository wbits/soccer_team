<?php

namespace Wbits\SoccerTeam\Serializer;

use Wbits\SoccerTeam\Team\Event\PlayerJoinsTheTeam;
use Wbits\SoccerTeam\Team\Player\Player;
use Wbits\SoccerTeam\Team\Property\Email;
use Wbits\SoccerTeam\Team\Property\Nickname;
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
            'team_id'  => (string) $event->getTeamId(),
            'email'    => (string) $event->getPlayer()->getEmail(),
            'nickname' => (string) $event->getPlayer()->getNickname(),
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
                new Email($data['email']),
                new Nickname($data['nickname'])
            )
        );
    }
}

