<?php

namespace Wbits\SoccerTeam\Serializer;

use Wbits\SoccerTeam\Team\Player\Player;
use Wbits\SoccerTeam\Team\Property\Email;
use Wbits\SoccerTeam\Team\Property\Nickname;

class PlayerSerializer
{
    /**
     * @param Player $player
     *
     * @return array
     */
    public static function serialize(Player $player): array
    {
        return [
            'email_address' => (string) $player->getEmail(),
            'nickname'      => (string) $player->getNickname(),
        ];
    }

    /**
     * @param array $data
     *
     * @return Player
     */
    public static function deserialize(array $data): Player
    {
        return new Player(
            new Email($data['email_address']),
            new Nickname($data['nickname'])
        );
    }
}