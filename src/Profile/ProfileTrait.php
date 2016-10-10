<?php

namespace Wbits\SoccerTeam\Profile;

use Doctrine\Common\Collections\ArrayCollection;

trait ProfileTrait
{
    use NameTrait;

    /**
     * @var Address
     */
    private $address;

    /**
     * @var ArrayCollection|TelephoneNumber[]
     */
    private $telephoneNumbers;

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     *
     * @return $this
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return ArrayCollection|TelephoneNumber[]
     */
    public function getTelephoneNumbers(): ArrayCollection
    {
        return $this->telephoneNumbers;
    }

    /**
     * @param TelephoneNumber $number
     *
     * @return $this
     */
    public function addTelephoneNumber(TelephoneNumber $number)
    {
        $this->telephoneNumbers[] = $number;

        return $this;
    }

    /**
     * @param TelephoneNumber $number
     *
     * @return $this
     */
    public function removeTelephoneNumber(TelephoneNumber $number)
    {
        $this->telephoneNumbers->removeElement($number);

        return $this;
    }
}
