<?php

namespace Wbits\SoccerTeam\Team;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Wbits\SoccerTeam\Team\Event\TeamWasCreated;
use Wbits\SoccerTeam\Team\Player\Player;
use Wbits\SoccerTeam\Team\TeamAction\AddRemovePlayerTrait;
use Wbits\SoccerTeam\Team\TeamAction\MatchActionsTrait;
use Wbits\SoccerTeam\Team\TeamAction\PlayerActionsTrait;

class Team extends EventSourcedAggregateRoot
{
    use AddRemovePlayerTrait;
    use MatchActionsTrait;
    use PlayerActionsTrait;

    /**
     * @var TeamId
     */
    private $teamId;

    /**
     * @var TeamInformation
     */
    private $information;

    public function getAggregateRootId()
    {
        return $this->teamId;
    }

    /**
     * @return Player[]
     */
    public function getChildEntities(): array
    {
        $players = $this->getPlayerCollection()->toArray();
        $matches = $this->getSeason()->toArray();

        return $players + $matches;
    }

    /**
     * @param TeamId          $teamId
     * @param TeamInformation $information
     *
     * @return Team
     */
    public static function create(TeamId $teamId, TeamInformation $information)
    {
        $team = new self();

        $event = new TeamWasCreated($teamId, $information);
        $team->apply($event);

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
}
