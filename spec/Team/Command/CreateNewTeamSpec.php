<?php

namespace spec\Wbits\SoccerTeam\Team\Command;

use Wbits\SoccerTeam\Team\Command\CreateNewTeam;
use PhpSpec\ObjectBehavior;
use Wbits\SoccerTeam\Team\TeamId;
use Wbits\SoccerTeam\Team\TeamInformation;

class CreateNewTeamSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CreateNewTeam::class);
    }

    function let(TeamId $teamId, TeamInformation $information)
    {
        $this->beConstructedWith($teamId, $information);
    }

    function it_should_have_a_team_id()
    {
        $result = $this->getTeamId();
        $result->shouldBeAnInstanceOf(TeamId::class);
    }

    function it_should_have_team_information()
    {
        $this->getInformation()->shouldReturnAnInstanceOf(TeamInformation::class);
    }
}
