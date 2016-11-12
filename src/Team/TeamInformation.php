<?php

namespace Wbits\SoccerTeam\Team;

use Assert\Assertion as Assert;

final class TeamInformation
{
    /**
     * @var string
     */
    private $club;

    /**
     * @var string
     */
    private $team;

    /**
     * @var string
     */
    private $season;

    /**
     * @param string $club
     * @param string $team
     * @param string $season
     */
    public function __construct(string $club, string $team, string $season)
    {
        Assert::regex($season, '/\d{4}-\d{4}/', 'season should look for example as follows \'2016-2017\'');

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
}
