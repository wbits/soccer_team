<?php

namespace Wbits\SoccerTeam\Team\Property;

final class Nickname
{
    /**
     * @var string
     */
    private $nickname;

    /**
     * @param string $nickname
     */
    public function __construct(string $nickname)
    {
        $this->nickname = $nickname;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->nickname;
    }
}
