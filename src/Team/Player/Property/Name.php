<?php

namespace Wbits\SoccerTeam\Player\Property;

final class Name
{
    public $firstName;
    public $lastName;

    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName    = $firstName;
        $this->lastName     = $lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}
