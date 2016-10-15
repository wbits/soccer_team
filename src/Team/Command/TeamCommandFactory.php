<?php

namespace Wbits\SoccerTeam\Team\Command;

use Assert\Assertion as Assert;
use Broadway\UuidGenerator\UuidGeneratorInterface;
use Wbits\SoccerTeam\Team\TeamId;
use Wbits\SoccerTeam\Team\TeamInformation;
use Wbits\SoccerTeam\Player\Player;
use Wbits\SoccerTeam\Player\Property\Name;

class TeamCommandFactory
{
    private $uuidGenerator;

    public function __construct(UuidGeneratorInterface $uuidGenerator)
    {
        $this->uuidGenerator = $uuidGenerator;
    }

    public function createCreateNewTeamCommand(array $params): CreateNewTeam
    {
        Assert::keyIsset($params, 'club');
        Assert::keyIsset($params, 'team');
        Assert::keyIsset($params, 'season');

        $teamId = new TeamId($this->uuidGenerator->generate());
        $information = new TeamInformation($params['club'], $params['team'], $params['season']);

        return new CreateNewTeam($teamId, $information);
    }

    public function createAddPlayerCommand(array $params, string $teamId): AddPlayer
    {
        Assert::keyIsset($params, 'first_name');
        Assert::keyIsset($params, 'last_name');

        return new AddPlayer(
            new TeamId($teamId),
            new Player(new Name($params['first_name'], $params['last_name']))
        );
    }
}
