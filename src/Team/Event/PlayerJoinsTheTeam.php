<?php

namespace Wbits\SoccerTeam\Team\Event;

use Wbits\SoccerTeam\Team\TeamId;

class PlayerJoinsTheTeam extends AbstractTeamEvent
{
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
        parent::__construct($teamId);

        $this->emailAddress = $emailAddress;
        $this->firstName    = $firstName;
        $this->lastName     = $lastName;
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
    public function serialize(): array
    {
        return array_merge(
            parent::serialize(),
            [
                'email_address' => $this->emailAddress,
                'first_name'    => $this->firstName,
                'last_name'     => $this->lastName,
            ]
        );
    }

    /**
     * @param array $data
     *
     * @return PlayerJoinsTheTeam
     */
    public static function deserialize(array $data): PlayerJoinsTheTeam
    {
        return new self(
            self::getTeamIdInstance($data['team_id']),
            $data['email_address'],
            $data['first_name'],
            $data['last_name']
        );
    }
}
