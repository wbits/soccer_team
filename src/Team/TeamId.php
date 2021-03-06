<?php

namespace Wbits\SoccerTeam\Team;

use Assert\Assertion as Assert;
use JMS\Serializer\Annotation as Serializer;
use Wbits\SoccerTeam\Identifier;

/**
 * @Serializer\ExclusionPolicy("none")
 */
final class TeamId implements Identifier
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
