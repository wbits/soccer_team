<?php

namespace Wbits\SoccerTeam\Team\Event;

use Broadway\Serializer\SerializableInterface;
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
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        $opponent = $data['opponent'];
        $address = $data['opponent']['address'];

        return new self(
            new TeamId($data['team_id']),
            $data['match_id'],
            new \DateTime($data['kick_off']),
            new Opponent(
                $opponent['club'],
                $opponent['team'],
                new Address(
                    $address['street_name'],
                    $address['house_number'],
                    $address['postal_code'],
                    $address['city']
                )
            )
        );
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'team_id'  => (string) $this->teamId,
            'match_id' => $this->matchId,
            'kickoff'  => $this->kickOff->format(DATE_ISO8601),
            'opponent' => [
                'club' => $this->opponent->getClub(),
                'team' => $this->opponent->getTeam(),
                'address' => [
                    'street_name' => $this->opponent->getAddress()->getStreetName(),
                    'house_number' => $this->opponent->getAddress()->getHouseNumber(),
                    'postal_code' => $this->opponent->getAddress()->getPostalCode(),
                    'city' => $this->opponent->getAddress()->getCity(),
                ],
            ],
        ];
    }
}
