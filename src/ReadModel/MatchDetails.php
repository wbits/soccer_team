<?php

namespace Wbits\SoccerTeam\ReadModel;

use Broadway\ReadModel\ReadModelInterface;
use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\Serializer\MatchSerializer;
use Wbits\SoccerTeam\Serializer\PlayerSerializer;
use Wbits\SoccerTeam\Team\Match\Match;
use Wbits\SoccerTeam\Team\Player\PlayerCollection;

class MatchDetails implements ReadModelInterface, SerializableInterface
{
    /**
     * @var Match
     */
    private $match;

    /**
     * @var PlayerCollection
     */
    private $availablePlayers;

    /**
     * @var PlayerCollection
     */
    private $unavailablePlayers;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->match->getMatchId();
    }

    public function getMatch()
    {
        return $this->match;
    }

    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        // TODO: Implement deserialize() method.
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return [
            'id'          => $this->getId(),
            'match'       => MatchSerializer::serialize($this->match),
            'available'   => array_map([PlayerSerializer::class, 'serialize'], $this->availablePlayers->toArray()),
            'unavailable' => array_map([PlayerSerializer::class, 'serialize'], $this->unavailablePlayers->toArray()),
        ];
    }
}
