<?php

namespace spec\Wbits\SoccerTeam\Team\Command;

use Assert\AssertionFailedException;
use Broadway\UuidGenerator\UuidGeneratorInterface;
use Wbits\SoccerTeam\Team\Command\CreateNewTeam;
use Wbits\SoccerTeam\Team\Command\TeamCommandFactory;
use PhpSpec\ObjectBehavior;

class TeamCommandFactorySpec extends ObjectBehavior
{
    const UUID = 'e283947b-03b6-403c-8451-565c2c2c0780';

    function it_is_initializable()
    {
        $this->shouldHaveType(TeamCommandFactory::class);
    }

    function let(UuidGeneratorInterface $generator)
    {
        $this->beConstructedWith($generator);
    }

    function it_should_validate_club_team_and_season()
    {
        $this->shouldThrow(AssertionFailedException::class)->during(
            'createCreateNewTeamCommand',
            [['team' => 'foo', 'season' => '1900-1901']]
        );
        $this->shouldThrow(AssertionFailedException::class)->during(
            'createCreateNewTeamCommand',
            [['club' => 'bar', 'season' => '1900-1901']]
        );
        $this->shouldThrow(AssertionFailedException::class)->during(
            'createCreateNewTeamCommand',
            [['team' => 'foo', 'club' => 'bar']]
        );
    }

    function it_should_create_a_create_new_team_command(UuidGeneratorInterface $generator)
    {
        $generator->generate()->willReturn(self::UUID);
        $result = $this->createCreateNewTeamCommand(['team' => 'foo', 'club' => 'bar', 'season' => '1900-1901']);
        $result->shouldBeAnInstanceOf(CreateNewTeam::class);
    }
}
