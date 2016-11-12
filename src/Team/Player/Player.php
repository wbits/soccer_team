<?php

namespace Wbits\SoccerTeam\Team\Player;

use Broadway\EventSourcing\EventSourcedEntity;
use Wbits\SoccerTeam\Team\Property\Email;
use Wbits\SoccerTeam\Team\Property\Nickname;

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
     * @param Email    $email
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
}
