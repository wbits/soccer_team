<?php

namespace spec\Wbits\SoccerTeam\Team\Command;

use Assert\AssertionFailedException;
use Broadway\UuidGenerator\UuidGeneratorInterface;
use Wbits\SoccerTeam\Team\Command\CreateNewTeam;
use Wbits\SoccerTeam\Team\Command\TeamCommandFactory;
use PhpSpec\ObjectBehavior;

class TeamCommandFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TeamCommandFactory::class);
    }

    function let(UuidGeneratorInterface $generator)
    {
        $this->beConstructedWith($generator);
    }

    function it_should_validate_club_team_and_season_are_passed_through_the_params_argument_when_creating_create_command()
    {
        $this->shouldThrow(AssertionFailedException::class)->during('createCreateNewTeamCommand', [['team' => 'foo', 'season' => '1900-1901']]);
        $this->shouldThrow(AssertionFailedException::class)->during('createCreateNewTeamCommand', [['club' => 'bar', 'season' => '1900-1901']]);
        $this->shouldThrow(AssertionFailedException::class)->during('createCreateNewTeamCommand', [['team' => 'foo', 'club' => 'bar']]);
    }

    function it_should_create_a_create_new_team_command()
    {
        $result = $this->createCreateNewTeamCommand(['team' => 'foo', 'club' => 'bar', 'season' => '1900-1901']);
        $result->shouldBeAnInstanceOf(CreateNewTeam::class);
    }
}
