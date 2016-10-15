<?php

namespace Wbits\SoccerTeam\SoccerTeamBundle\Controller;

use Assert\Assertion as Assert;
use Broadway\CommandHandling\CommandBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Wbits\SoccerTeam\Team\Command\TeamCommandFactory;

class TeamController
{
    private $commandBus;
    private $commandFactory;

    public function __construct(CommandBusInterface $commandBus, TeamCommandFactory $commandFactory)
    {
        $this->commandBus     = $commandBus;
        $this->commandFactory = $commandFactory;
    }

    public function createTeamAction(Request $request)
    {
        $payload = $request->getContent();

        Assert::notEmpty($payload);

        $params  = json_decode($payload, true);
        $command = $this->commandFactory->createCreateNewTeamCommand($params);
        $this->commandBus->dispatch($command);

        return new JsonResponse(['team_id' => (string)$command->getTeamId()]);
    }

    public function addPlayerAction(Request $request, string $teamId)
    {
        $payload = $request->getContent();

        Assert::notEmpty($payload);
        Assert::uuid($teamId);

        $params = json_decode($payload, true);

        $command = $this->commandFactory->createAddPlayerCommand($params, $teamId);
        $this->commandBus->dispatch($command);

        return new JsonResponse($command->toArray());
    }

    public function removePlayerAction()
    {

    }

    public function appointTrainerAction()
    {

    }

    public function fireTrainerAction()
    {

    }
}
