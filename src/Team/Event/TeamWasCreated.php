<?php

namespace Wbits\SoccerTeam\Team\Event;

use Wbits\SoccerTeam\Team\TeamId;

class TeamWasCreated extends AbstractTeamEvent
{
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
        parent::__construct($teamId);

        $this->club   = $club;
        $this->team   = $team;
        $this->season = $season;
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
     * @return array
     */
    public function serialize(): array
    {
        return array_merge(
            parent::serialize(),
            [
                'club'   => $this->club,
                'team'   => $this->team,
                'season' => $this->season,
            ]
        );
    }

    /**
     * @param array $data
     *
     * @return TeamWasCreated
     */
    public static function deserialize(array $data): TeamWasCreated
    {
        return new self(
            self::getTeamIdInstance($data['team_id']),
            $data['club'],
            $data['team'],
            $data['season']
        );
    }
}
