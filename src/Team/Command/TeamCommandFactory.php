<?php

namespace Wbits\SoccerTeam\Team\Command;

use Assert\Assertion as Assert;
use Broadway\UuidGenerator\UuidGeneratorInterface;
use Wbits\SoccerTeam\Team\Player\Player;
use Wbits\SoccerTeam\Team\Property\Address;
use Wbits\SoccerTeam\Team\Match\Opponent;
use Wbits\SoccerTeam\Team\Property\Email;
use Wbits\SoccerTeam\Team\Property\Nickname;
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
        Assert::keyIsset($params, 'nickname');

        $teamId = new TeamId($teamId);
        $player = new Player(
            new Email($params['email']),
            new Nickname($params['nickname'])
        );

        return new AddPlayer($teamId, $player);
    }

    /**
     * @param array $params
     * @param string $teamId
     *
     * @return RemovePlayer
     */
    public function createRemovePlayerCommand(array $params, string $teamId): RemovePlayer
    {
        Assert::keyIsset($params, 'email');

        $teamId = new TeamId($teamId);

        return new RemovePlayer($teamId, $params['email']);
    }

    /**
     * @param array $params
     * @param string $teamId
     *
     * @return ScheduleMatch
     */
    public function createScheduleMatchCommand(array $params, string $teamId): ScheduleMatch
    {
        Assert::keyIsset($params, 'match_id');
        Assert::keyIsset($params, 'kick_off');
        Assert::keyIsset($params, 'club');
        Assert::keyIsset($params, 'team');
        Assert::keyIsset($params, 'street_name');
        Assert::keyIsset($params, 'house_number');
        Assert::keyIsset($params, 'postal_code');
        Assert::keyIsset($params, 'city');

        $address  = new Address(
            $params['street_name'],
            $params['house_number'],
            $params['postal_code'],
            $params['city']
        );

        return new ScheduleMatch(
            new TeamId($teamId),
            $params['match_id'],
            new \DateTime($params['kick_off']),
            new Opponent($params['club'], $params['team'], $address)
        );
    }
}
