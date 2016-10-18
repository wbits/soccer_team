<?php

namespace Wbits\SoccerTeam\Team\Event;

use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\Team\TeamId;

class TeamWasCreated implements SerializableInterface
{
    private $teamId;
    private $club;
    private $team;
    private $season;

    /**
     * @param TeamId $teamId
     * @param string $club
     * @param string $team
     * @param string $season
     */
    public function __construct(TeamId $teamId, string $club, string $team, string $season)
    {
        $this->teamId = $teamId;
        $this->club   = $club;
        $this->team   = $team;
        $this->season = $season;
    }

    public function getTeamId(): TeamId
    {
        return $this->teamId;
    }

    /**
     * @return string
     */
    public function getClub(): string
    {
        return $this->club;
    }

    /**
     * @return string
     */
    public function getTeam(): string
    {
        return $this->team;
    }

    /**
     * @return string
     */
    public function getSeason(): string
    {
        return $this->season;
    }

    /**
     * @param array $data
     * @return TeamWasCreated
     */
    public static function deserialize(array $data): TeamWasCreated
    {
        return new self(
            new TeamId($data['team_id']),
            $data['club'],
            $data['team'],
            $data['season']
        );
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'team_id' => (string) $this->teamId,
            'club'    => $this->club,
            'team'    => $this->team,
            'season'  => $this->season,
        ];
    }
}
