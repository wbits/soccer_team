<?php

namespace spec\Wbits\SoccerTeam\Team;

use Assert\AssertionFailedException;
use PhpSpec\ObjectBehavior;
use Wbits\SoccerTeam\Identifier;
use Wbits\SoccerTeam\Team\TeamId;

class TeamIdSpec extends ObjectBehavior
{
    const UUID = 'e283947b-03b6-403c-8451-565c2c2c0780';

    function it_should_validate_team_id()
    {
        $this->shouldThrow(AssertionFailedException::class)->during('__construct', ['foo']);
    }

    function it_should_return_each_value_separate()
    {
        $this->beConstructedWith(self::UUID);
        $this->shouldHaveType(TeamId::class);
        $this->shouldImplement(Identifier::class);

        $this->__toString()->shouldEqual(self::UUID);
    }
}
