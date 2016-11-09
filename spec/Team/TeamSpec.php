<?php

namespace spec\Wbits\SoccerTeam\Team;

use Wbits\SoccerTeam\Team\Team;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Wbits\SoccerTeam\Team\TeamId;

class TeamSpec extends ObjectBehavior
{
    const TEAM_ID = '00000000-0000-0000-0000-000000000000';

    function it_is_initializable()
    {
        $this->shouldHaveType(Team::class);
    }

    function it_should_add_a_player_to_the_team()
    {
        $team = $this->create(new TeamId(self::TEAM_ID), 'zoo', 'zap', '2016-2017');
        $team->addPlayerToTheTeam('foo@bar.baz', 'foo', 'bar');
    }
}
