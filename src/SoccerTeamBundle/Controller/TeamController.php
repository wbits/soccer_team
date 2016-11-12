<?php

namespace Wbits\SoccerTeam\SoccerTeamBundle\Controller;

use Assert\Assertion as Assert;
use Broadway\CommandHandling\CommandBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Wbits\SoccerTeam\Team\Command\ScheduleMatch;
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
    public function createTeamAction(Request $request): JsonResponse
    {
        $params  = $this->getRequestPayload($request->getContent());
        $command = $this->dispatchCommand('createCreateNewTeamCommand', [$params]);

        return new JsonResponse([
            'team_id' => (string) $command->getTeamId(),
            'club'    => $command->getInformation()->getClub(),
            'team'    => $command->getInformation()->getTeam(),
            'season'  => $command->getInformation()->getSeason(),
        ]);
    }

    /**
     * @param Request $request
     * @param string  $teamId
     *
     * @return JsonResponse
     */
    public function addPlayerAction(Request $request, string $teamId): JsonResponse
    {
        return $this->playerAction($request, $teamId, 'createAddPlayerCommand');
    }

    /**
     * @param Request $request
     * @param string  $teamId
     *
     * @return JsonResponse
     */
    public function removePlayerAction(Request $request, string $teamId): JsonResponse
    {
        return $this->playerAction($request, $teamId, 'createRemovePlayerCommand');
    }

    public function appointTrainerAction()
    {
    }

    public function fireTrainerAction()
    {
    }

    public function scheduleMatchAction(Request $request, string $teamId): JsonResponse
    {
        Assert::uuid($teamId);

        $params  = $this->getRequestPayload($request->getContent());
        $command = $this->dispatchCommand('createScheduleMatchCommand', [$params, $teamId]);

        return new JsonResponse([
            'team_id'  => (string) $command->getTeamId(),
            'match_id' => $command->getMatchId(),
            'kick_off' => $command->getKickOff()->format(DATE_ISO8601),
            'opponent' => sprintf('%s-%s', $command->getOpponent()->getClub(), $command->getOpponent()->getTeam()),
        ]);
    }

    /**
     * @param Request $request
     * @param string $teamId
     * @param string $commandFactoryMethod
     *
     * @return JsonResponse
     */
    private function playerAction(Request $request, string $teamId, string $commandFactoryMethod)
    {
        Assert::uuid($teamId);

        $params  = $this->getRequestPayload($request->getContent());
        $command = $this->dispatchCommand($commandFactoryMethod, [$params, $teamId]);

        return new JsonResponse([
            'team_id'  => (string) $command->getTeamId(),
            'nickname' => (string) $command->getPlayer()->getNickname(),
            'email'    => (string) $command->getPlayer()->getEmail(),
        ]);
    }

    /**
     * @param string $payload
     *
     * @return array
     */
    private function getRequestPayload(string $payload): array
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
