<?php

namespace Wbits\SoccerTeam\Team;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Doctrine\Common\Collections\ArrayCollection;
use Wbits\SoccerTeam\Team\Event\PlayerJoinsTheTeam;
use Wbits\SoccerTeam\Team\Event\TeamStartsNewSeason;
use Wbits\SoccerTeam\Player\Player;

class Team extends EventSourcedAggregateRoot
{
    private $teamId;

    /**
     * @var ArrayCollection|Player[]
     */
    private $players;

    public static function startNewSeason(TeamId $teamId, TeamInformation $information)
    {
        $team = new Team();
        $team->apply(new TeamStartsNewSeason($teamId, $information));

        return $team;
    }

    public function applyTeamStartsNewSeason(TeamStartsNewSeason $event)
    {
        $this->teamId = $event->getTeamId();
    }

    public function addPlayer(Player $player)
    {
        $this->apply(new PlayerJoinsTheTeam($this->teamId, $player));
    }


    public function applyPlayerJoinsTheTeam(PlayerJoinsTheTeam $event)
    {
        $player  = $event->getPlayer();

        if ($this->getPlayers()->contains($player)) {
            return;
        }

        $this->players[] = $player;
    }

    public function getAggregateRootId()
    {
        return $this->teamId;
    }

    private function getPlayers(): ArrayCollection
    {
        if (is_null($this->players)) {
            $this->players = new ArrayCollection();
        }

        return $this->players;
    }
}
