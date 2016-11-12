<?php

namespace Wbits\SoccerTeam\ReadModel;

use Broadway\ReadModel\ReadModelInterface;
use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\Serializer\PlayerSerializer;
use Wbits\SoccerTeam\Team\Player\Player;
use Wbits\SoccerTeam\Team\Player\PlayerCollection;

class PlayersInTheTeam implements ReadModelInterface, SerializableInterface
{
    /**
     * @var string
     */
    private $teamId;

    /**
     * @var PlayerCollection
     */
    private $players;

    /**
     * @param string $teamId
     */
    public function __construct(string $teamId)
    {
        $this->teamId = $teamId;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->teamId;
    }

    /**
     * @param Player $player
     */
    public function addPlayer(Player $player)
    {
        $this->players   = $this->players ?? new PlayerCollection();
        $this->players[] = $player;
    }

    /**
     * @param Player $player
     */
    public function removePlayer(Player $player)
    {
        $filteredPlayers    = $this->players->filterByNickname((string) $player->getNickname());
        $elementToBeRemoved = $filteredPlayers->first();

        $this->players->removeElement($elementToBeRemoved);
    }

    /**
     * @param array $data
     *
     * @return PlayersInTheTeam
     */
    public static function deserialize(array $data): PlayersInTheTeam
    {
        $playersInTheTeam          = new self($data['teamId']);
        $playersInTheTeam->players = self::getPlayersDeserialized($data['players']);

        return $playersInTheTeam;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'teamId'  => $this->teamId,
            'players' => $this->getPlayersSerialized(),
        ];
    }

    /**
     * @param array $players
     *
     * @return PlayerCollection
     */
    private static function getPlayersDeserialized(array $players): PlayerCollection
    {
        $playersDeserialize = [];

        if (count($players)) {
            $playersDeserialize = array_map([PlayerSerializer::class, 'deserialize'], $players);
        }

        return new PlayerCollection($playersDeserialize);
    }

    /**
     * @return array
     */
    private function getPlayersSerialized(): array
    {
        if (! $this->players) {
            return [];
        }

        return array_map([PlayerSerializer::class, 'serialize'], $this->players->toArray());
    }
}
