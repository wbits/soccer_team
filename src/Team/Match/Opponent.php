<?php

namespace Wbits\SoccerTeam\Team\Match;

use Wbits\SoccerTeam\PLayer\Property\Address;

class Opponent
{
    /**
     * @var string
     */
    private $club;

    /**
     * @var string
     */
    private $team;

    /**
     * @var Address
     */
    private $address;

    /**
     * Opponent constructor.
     * @param string $club
     * @param string $team
     * @param Address $address
     */
    public function __construct(string $club, string $team, Address $address)
    {
        $this->club    = $club;
        $this->team    = $team;
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getClub(): string
    {
        return $this->club;
    }

    /**
     * @return string
     */
    public function getTeam(): string
    {
        return $this->team;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }
}
