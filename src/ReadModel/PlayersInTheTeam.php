<?php

namespace Wbits\SoccerTeam\ReadModel;

use Broadway\ReadModel\ReadModelInterface;
use Broadway\Serializer\SerializableInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Wbits\SoccerTeam\Team\Player\Player;

class PlayersInTheTeam implements ReadModelInterface, SerializableInterface
{
    /**
     * @var string
     */
    private $teamId;

    /**
     * @var ArrayCollection
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
        $this->players   = $this->players ?? new ArrayCollection();
        $this->players[] = $player;
    }

    /**
     * @param string $emailAddress
     */
    public function removePlayerByEmailAddress(string $emailAddress)
    {
        $player = $this->players->filter(function (Player $player) use ($emailAddress) {
            return (string)$player->getEmail() === $emailAddress;
        })->first();

        if (!$player) {
            return;
        }

        $this->removePlayer($player);
    }

    /**
     * @param Player $player
     */
    private function removePlayer(Player $player)
    {
        $this->players->removeElement($player);
    }

    /**
     * @param array $data
     *
     * @return PlayersInTheTeam
     */
    public static function deserialize(array $data): PlayersInTheTeam
    {
        $playersInTheTeam = new self($data['teamId']);
        $playersInTheTeam->players = self::getPlayersDeserialize($data['players']);

        return $playersInTheTeam;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'teamId' => $this->teamId,
            'players' => $this->getPlayersSerialized()
        ];
    }

    /**
     * @param array $players
     *
     * @return ArrayCollection
     */
    private static function getPlayersDeserialize(array $players): ArrayCollection
    {
        $playersDeserialize = [];

        if (count($players)) {
            $playersDeserialize = array_map(self::deserializePlayersCallback(), $players);
        }

        return new ArrayCollection($playersDeserialize);
    }

    /**
     * @return array
     */
    private function getPlayersSerialized(): array
    {
        if (! $this->players) {
            return [];
        }

        return array_map(
            self::serializePlayersCallback(),
            $this->players->toArray()
        );
    }

    /**
     * @return \Closure
     */
    private static function deserializePlayersCallback(): \Closure
    {
        return function (array $player) {
            return Player::create(
                $player['email_address'],
                $player['first_name'],
                $player['last_name']
            );
        };
    }

    /**
     * @return \Closure
     */
    private static function serializePlayersCallback(): \Closure
    {
        return function (Player $player) {
            return [
                'email_address' => (string) $player->getEmail(),
                'first_name'    => $player->getName()->getNickname(),
                'last_name'     => $player->getName()->getLastName(),
            ];
        };
    }
}
