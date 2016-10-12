<?php

namespace Wbits\SoccerTeam\SoccerTeamBundle\Controller;

use Broadway\CommandHandling\CommandBusInterface;
use Broadway\UuidGenerator\UuidGeneratorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Wbits\SoccerTeam\TeamMember\Command\JoinTheTeam;
use Wbits\SoccerTeam\TeamMember\Property\Name;
use Wbits\SoccerTeam\TeamMember\Property\TeamMemberId;

class TeamMemberController
{
    private $commandBus;
    private $uuidGenerator;

    public function __construct(CommandBusInterface $commandBus, UuidGeneratorInterface $uuidGenerator)
    {
        $this->commandBus    = $commandBus;
        $this->uuidGenerator = $uuidGenerator;
    }

    public function joinTheTeamAction($firstName, $lastName): JsonResponse
    {
        $memberId  = new TeamMemberId($this->uuidGenerator->generate());
        $command   = new JoinTheTeam($memberId, new Name($firstName, $lastName));

        $this->commandBus->dispatch($command);

        $responseData = [
            'id'        => (string) $memberId,
            'firstName' => $firstName,
            'lastName'  => $lastName,
        ];

        return new JsonResponse($responseData);
    }
}
