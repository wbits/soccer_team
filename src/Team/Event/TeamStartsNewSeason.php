<?php

namespace Wbits\SoccerTeam\Team\Event;

use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\Team\TeamId;
use Wbits\SoccerTeam\Team\TeamInformation;

class TeamStartsNewSeason implements SerializableInterface
{
    private $teamId;
    private $information;

    public function __construct(TeamId $teamId, TeamInformation $information)
    {
        $this->teamId      = $teamId;
        $this->information = $information;
    }
    /**
     * @return TeamId
     */
    public function getTeamId(): TeamId
    {
        return $this->teamId;
    }

    public function getInformation(): TeamInformation
    {
        return $this->information;
    }

    public function serialize(): array
    {
        return [
            'team_id'   => (string) $this->teamId,
            'team_name' => $this->information->getName(),
            'season'   => $this->information->getSeason(),
        ];
    }

    public static function deserialize(array $data): TeamStartsNewSeason
    {
        return new self(
            new TeamId($data['team_id']),
            new TeamInformation($data['team_name'], $data['season'])
        );
    }
}
