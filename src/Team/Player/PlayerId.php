<?php

namespace Wbits\SoccerTeam\Player\Property;

use Assert\Assertion as Assert;
use Wbits\SoccerTeam\Identifier;

class PlayerId implements Identifier
{
    /**
     * @var string
     */
    private $playerId;

    /**
     * @param string $playerId
     */
    public function __construct(string $playerId)
    {
        Assert::uuid($playerId);

        $this->playerId = $playerId;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->playerId;
    }
}
