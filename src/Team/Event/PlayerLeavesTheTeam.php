<?php

namespace Wbits\SoccerTeam\Team\Event;

use Wbits\SoccerTeam\Team\TeamId;

class PlayerLeavesTheTeam extends AbstractTeamEvent
{
    private $emailAddress;

    /**
     * @param TeamId $teamId
     * @param string $emailAddress
     */
    public function __construct(TeamId $teamId, string $emailAddress)
    {
        parent::__construct($teamId);
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return array_merge(
            parent::serialize(),
            [
                'email_address' => $this->emailAddress
            ]
        );
    }

    /**
     * @param array $data
     *
     * @return PlayerLeavesTheTeam
     */
    public static function deserialize(array $data): PlayerLeavesTheTeam
    {
        return new self(
            self::getTeamIdInstance($data['team_id']),
            $data['email_address']
        );
    }
}
