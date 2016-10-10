<?php

namespace spec\Wbits\SoccerTeam\Member;

use Wbits\SoccerTeam\Member\Player;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PlayerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Player::class);
    }
}
