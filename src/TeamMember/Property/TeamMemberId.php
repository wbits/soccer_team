<?php

namespace Wbits\SoccerTeam\TeamMember\Property;

use Wbits\SoccerTeam\Identifier;
use Assert\Assertion As Assert;

class TeamMemberId implements Identifier
{
    /**
     * @var string
     */
    private $teamMemberId;

    /**
     * @param string $teamMemberId
     */
    public function __construct(string $teamMemberId)
    {
        Assert::uuid($teamMemberId);

        $this->teamMemberId = $teamMemberId;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->teamMemberId;
    }
}
