<?php

namespace Wbits\SoccerTeam\Team;

use Assert\Assertion as Assert;
use Wbits\SoccerTeam\Identifier;

class TeamId implements Identifier
{
    /**
     * @var string
     */
    private $teamId;

    /**
     * @param string $teamId
     */
    public function __construct(string $teamId)
    {
        Assert::uuid($teamId);

        $this->teamId = $teamId;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->teamId;
    }
}
