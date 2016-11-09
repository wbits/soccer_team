<?php

namespace Wbits\SoccerTeam\Team\Event;

use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\Serializer\MatchWasScheduledSerializer;
use Wbits\SoccerTeam\Team\Property\Address;
use Wbits\SoccerTeam\Team\Match\Opponent;
use Wbits\SoccerTeam\Team\TeamId;

class MatchWasScheduled implements SerializableInterface
{
    /**
     * @var TeamId
     */
    private $teamId;

    /**
     * @var int
     */
    private $matchId;

    /**
     * @var \DateTime
     */
    private $kickOff;

    /**
     * @var Opponent
     */
    private $opponent;

    /**
     * @param TeamId $teamId
     * @param int $matchId
     * @param \DateTime $kickOff
     * @param Opponent $opponent
     */
    public function __construct(TeamId $teamId, int $matchId, \DateTime $kickOff, Opponent $opponent)
    {
        $this->teamId   = $teamId;
        $this->matchId  = $matchId;
        $this->kickOff  = $kickOff;
        $this->opponent = $opponent;
    }

    /**
     * @return TeamId
     */
    public function getTeamId(): TeamId
    {
        return $this->teamId;
    }

    /**
     * @return int
     */
    public function getMatchId(): int
    {
        return $this->matchId;
    }

    /**
     * @return \DateTime
     */
    public function getKickOff(): \DateTime
    {
        return $this->kickOff;
    }

    /**
     * @return Opponent
     */
    public function getOpponent(): Opponent
    {
        return $this->opponent;
    }

    /**
     * @param array $data
     *
     * @return MatchWasScheduled
     */
    public static function deserialize(array $data): MatchWasScheduled
    {
        return MatchWasScheduledSerializer::deserialize($data);
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return MatchWasScheduledSerializer::serialize($this);
    }
}
