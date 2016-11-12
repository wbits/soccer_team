<?php

namespace Wbits\SoccerTeam\Team\TeamAction;

use Wbits\SoccerTeam\SoccerTeamBundle\Exception\ValidationException;
use Wbits\SoccerTeam\Team\Event\PlayerJoinsTheTeam;
use Wbits\SoccerTeam\Team\Event\PlayerLeavesTheTeam;
use Wbits\SoccerTeam\Team\Player\Player;
use Wbits\SoccerTeam\Team\Player\PlayerCollection;

trait AddRemovePlayerTrait
{
    /**
     * @var PlayerCollection
     */
    private $players;

    /**
     * @param Player $player
     *
     * @throws ValidationException
     */
    public function addPlayerToTheTeam(Player $player)
    {
        $this->getPlayerCollection()->validateNewPlayer($player);

        $this->apply(
            new PlayerJoinsTheTeam(
                $this->teamId,
                $player
            )
        );
    }

    /**
     * @param PlayerJoinsTheTeam $event
     */
    public function applyPlayerJoinsTheTeam(PlayerJoinsTheTeam $event)
    {
        $this->getPlayerCollection()->addPlayer($event->getPlayer());
    }

    /**
     * @param Player $player
     */
    public function removePlayerFromTheTeam(Player $player)
    {
        if (! $this->getPlayerCollection()->containsKey((string) $player->getEmail())) {
            return;
        }

        $this->apply(new PlayerLeavesTheTeam($this->teamId, $player));
    }

    /**
     * @param PlayerLeavesTheTeam $event
     */
    public function applyPlayerLeavesTheTeam(PlayerLeavesTheTeam $event)
    {
        $this->getPlayerCollection()->remove(
            (string) $event->getPlayer()->getEmail()
        );
    }

    /**
     * @return PlayerCollection
     */
    private function getPlayerCollection(): PlayerCollection
    {
        $this->players = $this->players ?? new PlayerCollection();

        return $this->players;
    }
}
