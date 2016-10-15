<?php

namespace spec\Wbits\SoccerTeam\Team;

use Assert\AssertionFailedException;
use PhpSpec\ObjectBehavior;
use Wbits\SoccerTeam\Identifier;
use Wbits\SoccerTeam\Team\TeamId;

class TeamIdSpec extends ObjectBehavior
{
    function it_should_validate_season_to_match_given_pattern()
    {
        $this->shouldThrow(AssertionFailedException::class)->during('__construct', ['foo', 'bar', 'baz']);
    }

    function it_should_validate_club_and_team_are_not_empty()
    {
        $this->shouldThrow(AssertionFailedException::class)->during('__construct', ['', 'bar', '2017-2018']);
        $this->shouldThrow(AssertionFailedException::class)->during('__construct', ['foo', '', '2017-2018']);
    }

    function it_should_return_each_value_separate()
    {
        $this->beConstructedWith('foo', 'bar', '2016-2017');
        $this->shouldHaveType(TeamId::class);
        $this->shouldImplement(Identifier::class);

        $this->__toString()->shouldEqual('foo:bar:2016-2017');
    }

    function it_should_accept_an_array_through_variadic_function_call()
    {
        $id = 'jo:rock:2010-2011';
        $this->beConstructedWith(...explode(':', $id));

        $result = $this->__toString();
        $result->shouldEqual('jo:rock:2010-2011');
    }
}
