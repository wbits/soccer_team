<?php

namespace spec\Wbits\SoccerTeam\Team;

use Wbits\SoccerTeam\Team\Team;
use PhpSpec\ObjectBehavior;

class TeamSpec extends ObjectBehavior
{
    const TEAM_ID = '00000000-0000-0000-0000-000000000000';

    function it_is_initializable()
    {
        $this->shouldHaveType(Team::class);
    }
}
