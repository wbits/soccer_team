<?php

namespace Wbits\SoccerTeam\Team\Player;

use Wbits\SoccerTeam\Team\Property\Email;
use Wbits\SoccerTeam\Team\Property\Nickname;

interface PlayerInterface
{
    public function getEmail(): Email;
    public function getNickname(): Nickname;
}
