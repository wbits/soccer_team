<?php

namespace Wbits\SoccerTeam\Team\Command;

use Assert\Assertion as Assert;
use Broadway\UuidGenerator\UuidGeneratorInterface;
use Wbits\SoccerTeam\Team\TeamId;

class TeamCommandFactory
{
    /**
     * @var UuidGeneratorInterface
     */
    private $uuidGenerator;

    /**
     * @param UuidGeneratorInterface $uuidGenerator
     */
    public function __construct(UuidGeneratorInterface $uuidGenerator)
    {
        $this->uuidGenerator = $uuidGenerator;
    }

    /**
     * @param array $params
     *
     * @return CreateNewTeam
     */
    public function createCreateNewTeamCommand(array $params): CreateNewTeam
    {
        Assert::keyIsset($params, 'club');
        Assert::keyIsset($params, 'team');
        Assert::keyIsset($params, 'season');

        $teamId = new TeamId($this->uuidGenerator->generate());

        return new CreateNewTeam($teamId, $params['club'], $params['team'], $params['season']);
    }

    /**
     * @param array  $params
     * @param string $teamId
     *
     * @return AddPlayer
     */
    public function createAddPlayerCommand(array $params, string $teamId): AddPlayer
    {
        Assert::keyIsset($params, 'email');
        Assert::keyIsset($params, 'first_name');
        Assert::keyIsset($params, 'last_name');

        $teamId = new TeamId($teamId);

        return new AddPlayer($teamId, $params['email'], $params['first_name'], $params['last_name']);
    }

    /**
     * @param $params
     * @param $teamId
     *
     * @return RemovePlayer
     */
    public function createRemovePlayerCommand($params, $teamId)
    {
        Assert::keyIsset($params, 'email');

        $teamId = new TeamId($teamId);

        return new RemovePlayer($teamId, $params['email']);
    }
}
