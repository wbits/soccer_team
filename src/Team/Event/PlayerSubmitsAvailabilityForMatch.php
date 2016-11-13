<?php

namespace Wbits\SoccerTeam\Team\Event;

use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\Serializer\MatchSerializer;
use Wbits\SoccerTeam\Serializer\PlayerSerializer;
use Wbits\SoccerTeam\Team\Command\PlayerTrait;
use Wbits\SoccerTeam\Team\Match\Match;
use Wbits\SoccerTeam\Team\TeamId;

class PlayerSubmitsAvailabilityForMatch implements SerializableInterface
{
    use PlayerTrait;

    /**
     * @var Match
     */
    private $match;

    /**
     * @return Match
     */
    public function getMatch(): Match
    {
        return $this->match;
    }

    /**
     * @param Match $match
     */
    public function setMatch(Match $match)
    {
        $this->match = $match;
    }

    /**
     * @param array $data
     *
     * @return PlayerSubmitsAvailabilityForMatch
     */
    public static function deserialize(array $data): PlayerSubmitsAvailabilityForMatch
    {
        $event = new self(
            new TeamId($data['teamId']),
            PlayerSerializer::deserialize($data['player'])
        );

        $event->setMatch(MatchSerializer::deserialize($data['match']));

        return $event;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'teamId' => (string) $this->getTeamId(),
            'player' => PlayerSerializer::serialize($this->getPlayer()),
            'match'  => MatchSerializer::serialize($this->getMatch()),
        ];
    }
}
