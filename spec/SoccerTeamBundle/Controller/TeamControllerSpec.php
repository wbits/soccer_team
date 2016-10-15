<?php

namespace spec\Wbits\SoccerTeam\SoccerTeamBundle\Controller;

use Broadway\CommandHandling\CommandBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Wbits\SoccerTeam\SoccerTeamBundle\Controller\TeamController;
use PhpSpec\ObjectBehavior;
use Wbits\SoccerTeam\Team\Command\CreateNewTeam;
use Wbits\SoccerTeam\Team\Command\TeamCommandFactory;
use Wbits\SoccerTeam\Team\TeamId;

class TeamControllerSpec extends ObjectBehavior
{
    const PARAMS = ['foo' => 'bar'];

    function it_is_initializable()
    {
        $this->shouldHaveType(TeamController::class);
    }

    function let(CommandBusInterface $commandBus, TeamCommandFactory $commandFactory)
    {
        $this->beConstructedWith($commandBus, $commandFactory);
    }

    function it_should_respond_to_create_team_action(
        Request $request,
        TeamCommandFactory $commandFactory,
        CreateNewTeam $command,
        TeamId $teamId
    ) {
        $payLoad = json_encode(self::PARAMS);
        $request->getContent()->willReturn($payLoad);
        $commandFactory->createCreateNewTeamCommand(self::PARAMS)->willReturn($command);
        $command->getTeamId()->willReturn($teamId);
        $teamId->__toString()->willReturn('foo');

        $this->createTeamAction($request)->shouldReturnAnInstanceOf(JsonResponse::class);
    }
}
