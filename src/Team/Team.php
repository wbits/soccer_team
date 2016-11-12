<?php

namespace Wbits\SoccerTeam\Team;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Doctrine\Common\Collections\ArrayCollection;
use Wbits\SoccerTeam\SoccerTeamBundle\Exception\ValidationException;
use Wbits\SoccerTeam\Team\Event\{MatchWasScheduled, PlayerJoinsTheTeam, PlayerLeavesTheTeam, TeamWasCreated};
use Wbits\SoccerTeam\Team\Match\{
    Match, Opponent, Season
};
use Wbits\SoccerTeam\Team\Player\Player;
use Wbits\SoccerTeam\Team\Player\PlayerCollection;

class Team extends EventSourcedAggregateRoot
{
    /**
     * @var TeamId
     */
    private $teamId;

    /**
     * @var TeamInformation
     */
    private $information;

    /**
     * @var PlayerCollection
     */
    private $players;

    /**
     * @var Season
     */
    private $season;

    /**
     * @param TeamId $teamId
     * @param TeamInformation $information
     *
     * @return Team
     */
    public static function create(TeamId $teamId, TeamInformation $information)
    {
        $team = new self();

        $team->apply(new TeamWasCreated($teamId, $information));

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
        if (! $this->players->containsKey((string) $player->getEmail())) {
            return;
        }

        $this->apply(new PlayerLeavesTheTeam($this->teamId, $player));
    }

    /**
     * @param PlayerLeavesTheTeam $event
     */
    public function applyPlayerLeavesTheTeam(PlayerLeavesTheTeam $event)
    {
        $this->players->remove(
            (string) $event->getPlayer()->getEmail()
        );
    }

    /**
     * @param Match $match
     */
    public function scheduleMatch(Match $match)
    {
        $this->getSeason()->validateScheduledMatch($match);

        $this->apply(new MatchWasScheduled($this->teamId, $match));
    }

    /**
     * @param MatchWasScheduled $event
     */
    public function applyMatchWasScheduled(MatchWasScheduled $event)
    {
        $match = $event->getMatch();

        $this->getSeason()->set($match->getMatchId(), $match);
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

    public function getAggregateRootId()
    {
        return $this->teamId;
    }

    /**
     * @return PlayerCollection
     */
    private function getPlayerCollection(): PlayerCollection
    {
        $this->players = $this->players ?? new PlayerCollection();
        return $this->players;
    }

    /**
     * @return Season
     */
    private function getSeason(): Season
    {
        $this->season = $this->season ?? new Season();
        return $this->season;
    }
}
