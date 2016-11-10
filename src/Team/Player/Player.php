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
    private $nickname;

    /**
     * @var Email
     */
    private $email;

    /**
     * @param Email $email
     * @param Nickname $name
     */
    public function __construct(Email $email, Nickname $name)
    {
        $this->email    = $email;
        $this->nickname = $name;
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
    public function getNickname(): Nickname
    {
        return $this->nickname;
    }

    /**
     * @param string $emailAddress
     * @param string $nickname
     * @return Player
     */
    public static function create(string $emailAddress, string $nickname): Player
    {
        $email = new Email($emailAddress);
        $name  = new Nickname($nickname);

        return new self($email, $name);
    }
}
