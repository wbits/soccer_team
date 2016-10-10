<?php

namespace Wbits\SoccerTeam\Event;

class PlayerJoinsTheTeamEvent
{
    /**
     * @var string
     */
    private $playerId;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @param string $playerId
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(string $playerId, string $firstName, string $lastName)
    {
        $this->playerId = $playerId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getPlayerId(): string
    {
        return $this->playerId;
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
}
