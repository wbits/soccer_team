<?php

namespace Wbits\SoccerTeam\Team\Event;

use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\Team\TeamId;

class TeamWasCreated implements SerializableInterface
{
    private $teamId;

    public function __construct(TeamId $teamId)
    {
        $this->teamId = $teamId;
    }

    public function getTeamId(): TeamId
    {
        return $this->teamId;
    }

    public function serialize(): array
    {
        return [
            'team_id' => (string) $this->teamId,
        ];
    }

    public static function deserialize(array $data): TeamWasCreated
    {
        return new self(
            new TeamId(...explode(':', $data['team_id']))
        );
    }

    public function getInformation()
    {
    }
}
