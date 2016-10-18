<?php

namespace Wbits\SoccerTeam\Team\Event;

use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\Team\TeamId;

class PlayerJoinsTheTeam implements SerializableInterface
{
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
     * @param array $data
     * @return PlayerJoinsTheTeam
     */
    public static function deserialize(array $data): PlayerJoinsTheTeam
    {
        return new self(
            new TeamId($data['team_id']),
            $data['email_address'],
            $data['first_name'],
            $data['last_name']
        );
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'team_id'       => (string) $this->teamId,
            'email_address' => $this->emailAddress,
            'first_name'    => $this->firstName,
            'last_name'     => $this->lastName,
        ];
    }
}
