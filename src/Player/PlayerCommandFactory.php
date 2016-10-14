<?php

namespace Wbits\SoccerTeam\Player;

use Assert\Assertion as Assert;
use Broadway\UuidGenerator\UuidGeneratorInterface;
use Wbits\SoccerTeam\Player\Command\JoinTheTeam;
use Wbits\SoccerTeam\Player\Property\Name;
use Wbits\SoccerTeam\Player\Property\PlayerId;

class PlayerCommandFactory
{
    private $uuidGenerator;

    public function __construct(UuidGeneratorInterface $uuidGenerator)
    {
        $this->uuidGenerator = $uuidGenerator;
    }

    public function createJoinTheTeamCommand(array $properties): JoinTheTeam
    {
        Assert::keyIsset($properties, 'first_name');
        Assert::keyIsset($properties, 'last_name');

        $id   = new PlayerId($this->uuidGenerator->generate());
        $name = new Name($properties['first_name'], $properties['last_name']);

        return new JoinTheTeam($id, $name);
    }
}
