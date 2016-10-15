<?php

namespace spec\Wbits\SoccerTeam\Team;

use Wbits\SoccerTeam\Team\Event\TeamWasCreated;
use Wbits\SoccerTeam\Team\Team;
use PhpSpec\ObjectBehavior;
use Wbits\SoccerTeam\Team\TeamId;
use Wbits\SoccerTeam\Team\TeamInformation;

class TeamSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Team::class);
    }

    function it_should_create_a_new_team(TeamId $teamId, TeamInformation $information)
    {
        $this->create($teamId, $information)->shouldReturnAnInstanceOf(Team::class);
    }

    function it_should_listen_to_team_was_created_event(TeamWasCreated $event, TeamId $teamId, TeamInformation $information)
    {
        $event->getTeamId()->willReturn($teamId);
        $event->getInformation()->willReturn($information);
        $this->applyTeamWasCreated($event);

        $this->getAggregateRootId()->shouldReturn($teamId);
    }
}
