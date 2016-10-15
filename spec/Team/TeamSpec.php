<?php

namespace spec\Wbits\SoccerTeam\Team;

use Wbits\SoccerTeam\Team\Team;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TeamSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Team::class);
    }
}
