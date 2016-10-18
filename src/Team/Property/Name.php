<?php

namespace Wbits\SoccerTeam\Team\Property;

final class Name
{
    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $lnPrefix
     */
    public function __construct(string $firstName, string $lastName, string $lnPrefix = null)
    {
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
        $this->lnPrefix  = $lnPrefix;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getLnPrefix(): string
    {
        return $this->lnPrefix;
    }
}
