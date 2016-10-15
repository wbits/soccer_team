<?php

namespace Wbits\SoccerTeam\Player;

use Wbits\SoccerTeam\Player\Property\Name;

class Player
{
    private $name;

    public function __construct(Name $name)
    {
        $this->name = $name;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public static function create(string $firstName, string $lastName): Player
    {
        return new self (
            new Name($firstName, $lastName)
        );
    }
}
