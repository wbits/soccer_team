<?php

namespace Wbits\SoccerTeam\Team\Property;

class Address
{
    /**
     * @var string
     */
    private $streetName;

    /**
     * @var int
     */
    private $houseNumber;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $city;

    /**
     * @param string $streetName
     * @param int    $houseNumber
     * @param string $postalCode
     * @param string $city
     */
    public function __construct($streetName, $houseNumber, $postalCode, $city)
    {
        $this->streetName  = $streetName;
        $this->houseNumber = $houseNumber;
        $this->postalCode  = $postalCode;
        $this->city        = $city;
    }

    /**
     * @return string
     */
    public function getStreetName(): string
    {
        return $this->streetName;
    }

    /**
     * @param string $streetName
     *
     * @return Address
     */
    public function setStreetName(string $streetName): Address
    {
        $this->streetName = $streetName;

        return $this;
    }

    /**
     * @return int
     */
    public function getHouseNumber(): int
    {
        return $this->houseNumber;
    }

    /**
     * @param int $houseNumber
     *
     * @return Address
     */
    public function setHouseNumber(int $houseNumber): Address
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     *
     * @return Address
     */
    public function setPostalCode(string $postalCode): Address
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return Address
     */
    public function setCity(string $city): Address
    {
        $this->city = $city;

        return $this;
    }
}
