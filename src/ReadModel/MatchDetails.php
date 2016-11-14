<?php

namespace Wbits\SoccerTeam\ReadModel;

use Broadway\ReadModel\ReadModelInterface;
use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\Serializer\MatchSerializer;
use Wbits\SoccerTeam\Serializer\PlayerSerializer;
use Wbits\SoccerTeam\Team\Match\Opponent;
use Wbits\SoccerTeam\Team\Player\Player;
use Wbits\SoccerTeam\Team\Player\PlayerCollection;

class MatchDetails implements ReadModelInterface, SerializableInterface
{
    /**
     * @var string
     */
    private $matchId;

    /**
     * @var Opponent
     */
    private $opponent;

    /**
     * @var \DateTime
     */
    private $kickoff;

    /**
     * @var PlayerCollection
     */
    private $availablePlayers;

    /**
     * @var PlayerCollection
     */
    private $unavailablePlayers;

    /**
     * @param string $matchId
     */
    public function __construct(string $matchId)
    {
        $this->matchId            = $matchId;
        $this->availablePlayers   = new PlayerCollection();
        $this->unavailablePlayers = new PlayerCollection();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->matchId;
    }

    /**
     * @param Opponent $opponent
     */
    public function setOpponent(Opponent $opponent)
    {
        $this->opponent = $opponent;
    }

    /**
     * @param \DateTime $kickoff
     */
    public function setKickoff(\DateTime $kickoff)
    {
        $this->kickoff = $kickoff;
    }

    /**
     * @param Player $player
     */
    public function addPlayerWhoSubmittedAvailability(Player $player)
    {
        $filter = function (Player $p) use ($player) {
            return (string) $p->getEmail() !== (string) $player->getEmail();
        };

        $this->availablePlayers   = $this->availablePlayers->filter($filter);
        $this->unavailablePlayers = $this->unavailablePlayers->filter($filter);

        if (! $player->isAvailable()) {
            $this->unavailablePlayers[] = $player;
            return;
        }

        $this->availablePlayers[] = $player;
    }

    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        $availablePlayers   = array_map([PlayerSerializer::class, 'deserialize'], $data['available']);
        $unavailablePlayers = array_map([PlayerSerializer::class, 'deserialize'], $data['unavailable']);

        $matchDetails                     = new self($data['match_id']);
        $matchDetails->opponent           = MatchSerializer::deserializeOpponent($data['opponent']);
        $matchDetails->kickoff            = new \DateTime($data['kickoff']);
        $matchDetails->availablePlayers   = new PlayerCollection($availablePlayers);
        $matchDetails->unavailablePlayers = new PlayerCollection($unavailablePlayers);

        return $matchDetails;
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return [
            'match_id'    => $this->getId(),
            'opponent'    => MatchSerializer::serializeOpponent($this->opponent),
            'kickoff'     => $this->kickoff->format(DATE_ISO8601),
            'available'   => array_map([PlayerSerializer::class, 'serialize'], $this->availablePlayers->toArray()),
            'unavailable' => array_map([PlayerSerializer::class, 'serialize'], $this->unavailablePlayers->toArray()),
        ];
    }
}
