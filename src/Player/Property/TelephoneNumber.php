<?php

namespace Wbits\SoccerTeam\Player\Property;

class TelephoneNumber
{
    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $description;

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     *
     * @return TelephoneNumber
     */
    public function setNumber(string $number): TelephoneNumber
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return TelephoneNumber
     */
    public function setDescription(string $description): TelephoneNumber
    {
        $this->description = $description;

        return $this;
    }
}
