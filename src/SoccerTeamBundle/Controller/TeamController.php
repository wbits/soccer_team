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

    /**
     * @param CommandBusInterface $commandBus
     * @param TeamCommandFactory  $commandFactory
     */
    public function __construct(CommandBusInterface $commandBus, TeamCommandFactory $commandFactory)
    {
        $this->commandBus     = $commandBus;
        $this->commandFactory = $commandFactory;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function createTeamAction(Request $request)
    {
        $params  = $this->getParams($request->getContent());
        $command = $this->dispatchCommand('createCreateNewTeamCommand', [$params]);

        return new JsonResponse([
            'team_id' => (string) $command->getTeamId(),
            'club'    => $command->getClub(),
            'team'    => $command->getTeam(),
            'season'  => $command->getSeason(),
        ]);
    }

    /**
     * @param Request $request
     * @param string  $teamId
     *
     * @return JsonResponse
     */
    public function addPlayerAction(Request $request, string $teamId)
    {
        Assert::uuid($teamId);

        $params  = $this->getParams($request->getContent());
        $command = $this->dispatchCommand('createAddPlayerCommand', [$params, $teamId]);

        return new JsonResponse([
            'team_id'    => (string) $command->getTeamId(),
            'first_name' => $command->getFirstName(),
            'last_name'  => $command->getLastName(),
            'email'      => $command->getEmailAddress(),
        ]);
    }

    /**
     * @param Request $request
     * @param string  $teamId
     *
     * @return JsonResponse
     */
    public function removePlayerAction(Request $request, string $teamId)
    {
        Assert::uuid($teamId);

        $params  = $this->getParams($request->getContent());
        $command = $this->dispatchCommand('createRemovePlayerCommand', [$params, $teamId]);

        return new JsonResponse([
            'team_id' => (string) $command->getTeamId(),
            'email'   => $command->getEmailAddress(),
        ]);
    }

    public function appointTrainerAction()
    {
    }

    public function fireTrainerAction()
    {
    }

    /**
     * @param string $payload
     *
     * @return array
     */
    private function getParams(string $payload): array
    {
        Assert::isJsonString($payload, 'Post request failed because body contains invalid json');
        Assert::notEmpty($payload, 'Post request failed because post body was empty');

        return json_decode($payload, true);
    }

    /**
     * @param string $factoryMethodName
     * @param array  $args
     *
     * @return mixed
     */
    private function dispatchCommand(string $factoryMethodName, array $args)
    {
        $command = call_user_func_array([$this->commandFactory, $factoryMethodName], $args);

        $this->commandBus->dispatch($command);

        return $command;
    }
}
