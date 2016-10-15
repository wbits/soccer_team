<?php

namespace Wbits\SoccerTeam\Team;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Wbits\SoccerTeam\Team\Command\CreateNewTeam;
use Wbits\SoccerTeam\Team\Event\PlayerJoinsTheTeam;
use Wbits\SoccerTeam\Team\Event\TeamWasCreated;
use Wbits\SoccerTeam\Team\Player\Player;

class Team extends EventSourcedAggregateRoot
{
    private $teamId;

    /**
     * @var TeamInformation
     */
    private $information;

    /**
     * @var Player[]
     */
    private $players;

    /**
     * @param TeamId $teamId
     * @param TeamInformation $information
     * @return Team
     */
    public static function create(TeamId $teamId, TeamInformation $information)
    {
        $team = new Team();
        $team->apply(new CreateNewTeam($teamId, $information));

        return $team;
    }

    /**
     * @param TeamWasCreated $event
     */
    public function applyTeamWasCreated(TeamWasCreated $event)
    {
        $this->teamId      = $event->getTeamId();
        $this->information = $event->getInformation();
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
}
