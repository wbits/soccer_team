<?php

namespace Wbits\SoccerTeam\Team\Event;

use Broadway\Serializer\SerializableInterface;
use BroadwaySerialization\Serialization\Serializable;
use Wbits\SoccerTeam\Team\TeamId;

class PlayerJoinsTheTeam implements SerializableInterface
{
    use Serializable;

    /**
     * @var TeamId
     */
    private $teamId;
    private $emailAddress;
    private $firstName;
    private $lastName;

    /**
     * @param TeamId $teamId
     * @param string $emailAddress
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(TeamId $teamId, string $emailAddress, string $firstName, string $lastName)
    {
        $this->teamId       = $teamId;
        $this->emailAddress = $emailAddress;
        $this->firstName    = $firstName;
        $this->lastName     = $lastName;
    }

    /**
     * @return TeamId
     */
    public function getTeamId(): TeamId
    {
        return $this->teamId;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return array
     */
    protected static function deserializationCallbacks(): array
    {
        return [
            'team_id' => ['TeamId', 'deserialize'],
        ];
    }
}
