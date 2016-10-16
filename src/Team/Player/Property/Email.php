<?php

namespace Wbits\SoccerTeam\Team\Player\Property;

use Assert\Assertion as Assert;
use Wbits\SoccerTeam\Identifier;

class Email implements Identifier
{
    private $emailAddress;

    /**
     * @param string $emailAddress
     */
    public function __construct(string $emailAddress)
    {
        Assert::email($emailAddress, sprintf('%s is not a valid email address', $emailAddress));

        $this->emailAddress = $emailAddress;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->emailAddress;
    }
}
