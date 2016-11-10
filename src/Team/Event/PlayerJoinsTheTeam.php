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
    private $nickname;

    /**
     * @param TeamId $teamId
     * @param string $emailAddress
     * @param string $nickname
     */
    public function __construct(TeamId $teamId, string $emailAddress, string $nickname)
    {
        $this->teamId       = $teamId;
        $this->emailAddress = $emailAddress;
        $this->nickname     = $nickname;
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
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @param array $data
     *
     * @return PlayerJoinsTheTeam
     */
    public static function deserialize(array $data): PlayerJoinsTheTeam
    {
        return new self(
            new TeamId($data['team_id']),
            $data['email_address'],
            $data['nickname']
        );
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'team_id'       => (string)$this->teamId,
            'email_address' => $this->emailAddress,
            'nickname'      => $this->nickname,
        ];
    }
}
