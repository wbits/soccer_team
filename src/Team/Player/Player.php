<?php

namespace Wbits\SoccerTeam\Team\Player;

use Broadway\EventSourcing\EventSourcedEntity;
use JMS\Serializer\Annotation as Serializer;
use Wbits\SoccerTeam\Team\Property\{Email, Nickname};

class Player extends EventSourcedEntity
{
    /**
     * @var Nickname
     */
    private $name;

    /**
     * @var Email
     */
    private $email;

    /**
     * @param Email $email
     * @param Nickname  $name
     */
    public function __construct(Email $email, Nickname $name)
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
     * @return Nickname
     */
    public function getName(): Nickname
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
        $name  = new Nickname($firstName, $lastName);

        return new self($email, $name);
    }
}
