<?php

namespace Wbits\SoccerTeam\Team\Event;

use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\Team\TeamId;
use Wbits\SoccerTeam\Player\Player;
use Wbits\SoccerTeam\Player\Property\Name;

class PlayerJoinsTheTeam implements SerializableInterface
{
    private $teamId;
    private $player;

    public function __construct(TeamId $teamId, Player $player)
    {
        $this->teamId = $teamId;
        $this->player = $player;
    }

    public function getTeamId(): TeamId
    {
        return $this->teamId;
    }

    public function getPlayer(): Player
    {
        return $this->player;
    }

    public static function deserialize(array $data): PlayerJoinsTheTeam
    {
        $name = new Name($data['player_first_name'], $data['player_last_name']);

        return new self(New TeamId($data['team_id']), new Player($name));
    }

    public function serialize(): array
    {
        $name = $this->player->getName();

        return [
            'team_id'           => (string) $this->teamId,
            'player_first_name' => $name->getFirstName(),
            'player_last_name'  => $name->getLastName(),
        ];
    }
}
