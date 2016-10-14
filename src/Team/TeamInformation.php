<?php

namespace Wbits\SoccerTeam\Team;

use Assert\Assertion as Assert;

class TeamInformation
{
    private $name;
    private $season;

    public function __construct(string $name, string $season)
    {
        Assert::regex($season, '/\d{4}-\d{4}/', 'season should look for example as follows \'2016-20117\'');

        $this->name   = $name;
        $this->season = $season;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSeason(): string
    {
        return $this->season;
    }
}
