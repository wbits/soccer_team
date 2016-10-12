<?php

namespace Wbits\SoccerTeam\TeamMember\Event;

use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\TeamMember\Property\Name;
use Wbits\SoccerTeam\TeamMember\Property\TeamMemberId;

class TeamMemberJoinsTheTeam implements SerializableInterface
{
    private $memberId;
    private $name;

    public function __construct(TeamMemberId $memberId, Name $name)
    {
        $this->memberId = $memberId;
        $this->name     = $name;
    }

    public function getMemberId(): TeamMemberId
    {
        return $this->memberId;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public static function deserialize(array $data): TeamMemberJoinsTheTeam
    {
        $memberId = new TeamMemberId($data['teamMemberId']);
        $name     = new Name($data['firstName'], $data['lastName']);

        return new self($memberId, $name);
    }

    public function serialize(): array
    {
        return [
            'memberId'  => (string)$this->memberId,
            'firstName' => $this->name->getFirstName(),
            'lastName'  => $this->name->getLastName(),
        ];
    }
}
