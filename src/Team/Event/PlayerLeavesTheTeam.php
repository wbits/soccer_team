<?php

namespace Wbits\SoccerTeam\Team\Event;

use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\Team\TeamId;

class PlayerLeavesTheTeam implements SerializableInterface
{
    private $teamId;
    private $emailAddress;

    /**
     * @param TeamId $teamId
     * @param string $emailAddress
     */
    public function __construct(TeamId $teamId, string $emailAddress)
    {
        $this->teamId       = $teamId;
        $this->emailAddress = $emailAddress;
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
     * @return array
     */
    public function serialize(): array
    {
        return [
            'team_id'       => (string)$this->teamId,
            'email_address' => $this->emailAddress,
        ];

    }

    /**
     * @param array $data
     *
     * @return PlayerLeavesTheTeam
     */
    public static function deserialize(array $data): PlayerLeavesTheTeam
    {
        return new self(
            new TeamId($data['team_id']),
            $data['email_address']
        );
    }
}
