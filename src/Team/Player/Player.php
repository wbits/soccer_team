<?php

namespace Wbits\SoccerTeam\Team\Player;

use Broadway\EventSourcing\EventSourcedEntity;
use Wbits\SoccerTeam\Team\Property\Email;
use Wbits\SoccerTeam\Team\Property\Name;

class Player extends EventSourcedEntity
{
    /**
     * @var Name
     */
    private $name;

    /**
     * @var Email
     */
    private $email;

    /**
     * @param Email $email
     * @param Name  $name
     */
    public function __construct(Email $email, Name $name)
    {
        $this->email = $email;
        $this->name  = $name;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @param string $emailAddress
     * @param string $firstName
     * @param string $lastName
     *
     * @return Player
     */
    public static function create(string $emailAddress, string $firstName, string $lastName): Player
    {
        $email = new Email($emailAddress);
        $name  = new Name($firstName, $lastName);

        return new self($email, $name);
    }
}
