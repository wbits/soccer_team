<?php

namespace Wbits\SoccerTeam\SoccerTeamBundle\Controller;

use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Wbits\SoccerTeam\Team\Command\TeamRepository;
use Wbits\SoccerTeam\Team\Team;

class ViewController
{
    private $repository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(TeamRepository $repository, SerializerInterface $serializer)
    {
        $this->repository = $repository;
        $this->serializer = $serializer;
    }

    public function playersAction($teamId)
    {
        /** @var Team $team */
        $team = $this->repository->load($teamId);

        return new Response($this->serializer->serialize($team, 'json'));
    }
}
