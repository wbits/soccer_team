<?php

namespace Wbits\SoccerTeam\Team\Event;

use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\Team\TeamId;
use Wbits\SoccerTeam\Team\TeamInformation;

abstract class AbstractTeamEvent implements SerializableInterface
{
    /**
     * @var TeamId
     */
    protected $teamId;

    /**
     * @param TeamId $teamId
     */
    public function __construct(TeamId $teamId)
    {
        $this->teamId = $teamId;
    }

    /**
     * @return TeamId
     */
    public function getTeamId(): TeamId
    {
        return $this->teamId;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'team_id' => (string) $this->teamId,
        ];
    }

    /**
     * @param string $teamId
     *
     * @return TeamId
     */
    protected static function getTeamIdInstance(string $teamId): TeamId
    {
        return new TeamId($teamId);
    }

    /**
     * @param string $club
     * @param string $team
     * @param string $season
     *
     * @return TeamInformation
     */
    protected static function getTeamInformationInstance(string $club, string $team, string $season): TeamInformation
    {
        return new TeamInformation($club, $team, $season);
    }
}
