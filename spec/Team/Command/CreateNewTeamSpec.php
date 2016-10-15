<?php

namespace spec\Wbits\SoccerTeam\Team\Command;

use Wbits\SoccerTeam\Team\Command\CreateNewTeam;
use PhpSpec\ObjectBehavior;
use Wbits\SoccerTeam\Team\TeamId;

class CreateNewTeamSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CreateNewTeam::class);
    }

    function let(TeamId $teamId)
    {
        $this->beConstructedWith($teamId);
    }

    function it_should_have_a_team_id()
    {
        $result = $this->getTeamId();
        $result->shouldBeAnInstanceOf(TeamId::class);
    }
}
