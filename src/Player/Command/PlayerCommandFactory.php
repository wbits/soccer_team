<?php

namespace Wbits\SoccerTeam\Player\Command;

use Assert\Assertion as Assert;
use Broadway\UuidGenerator\UuidGeneratorInterface;
use Wbits\SoccerTeam\Player\Property\Name;
use Wbits\SoccerTeam\Player\Property\PlayerId;

class PlayerCommandFactory
{
    private $uuidGenerator;

    public function __construct(UuidGeneratorInterface $uuidGenerator)
    {
        $this->uuidGenerator = $uuidGenerator;
    }

    public function createJoinTheTeamCommand(array $params): JoinTheTeam
    {
        Assert::keyIsset($params, 'first_name');
        Assert::keyIsset($params, 'last_name');

        $id   = new PlayerId($this->uuidGenerator->generate());
        $name = new Name($params['first_name'], $params['last_name']);

        return new JoinTheTeam($id, $name);
    }
}
