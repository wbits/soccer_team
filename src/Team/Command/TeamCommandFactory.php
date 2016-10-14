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

    public function createStartNewSeasonCommand(array $params): StartNewSeason
    {
        Assert::keyIsset($params, 'team_name');
        Assert::keyIsset($params, 'season');

        $teamId = new TeamId($this->uuidGenerator->generate());
        $information = new TeamInformation($params['team_name'], $params['season']);

        return new StartNewSeason($teamId, $information);
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
