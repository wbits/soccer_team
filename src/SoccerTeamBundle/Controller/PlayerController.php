<?php

namespace Wbits\SoccerTeam\SoccerTeamBundle\Controller;

use Assert\Assertion as Assert;
use Broadway\CommandHandling\CommandBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Wbits\SoccerTeam\Player\Command\PlayerCommandFactory;

class PlayerController
{
    private $commandBus;
    private $commandFactory;

    public function __construct(CommandBusInterface $commandBus, PlayerCommandFactory $commandFactory)
    {
        $this->commandBus     = $commandBus;
        $this->commandFactory = $commandFactory;
    }

    public function joinTheTeamAction(Request $request): JsonResponse
    {
        $payLoad = $request->getContent();

        Assert::notEmpty($payLoad);

        $params  = json_decode($payLoad, true);
        $command = $this->commandFactory->createJoinTheTeamCommand($params);

        $this->commandBus->dispatch($command);

        return new JsonResponse($command->toArray());
    }
}
