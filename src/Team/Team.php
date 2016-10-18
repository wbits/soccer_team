<?php

namespace Wbits\SoccerTeam\Team;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Doctrine\Common\Collections\ArrayCollection;
use Wbits\SoccerTeam\Team\Event\MatchWasScheduled;
use Wbits\SoccerTeam\Team\Event\PlayerJoinsTheTeam;
use Wbits\SoccerTeam\Team\Event\PlayerLeavesTheTeam;
use Wbits\SoccerTeam\Team\Event\TeamWasCreated;
use Wbits\SoccerTeam\Team\Match\Match;
use Wbits\SoccerTeam\Team\Match\Opponent;
use Wbits\SoccerTeam\Team\Player\Player;

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
     * @var ArrayCollection|Player[]
     */
    private $players;

    /**
     * @var ArrayCollection|Match[]
     */
    private $matches;

    /**
     * @param TeamId $teamId
     * @param string $club
     * @param string $teamName
     * @param string $season
     *
     * @return Team
     */
    public static function create(TeamId $teamId, string $club, string $teamName, string $season)
    {
        $team = new self();

        $team->apply(
            new TeamWasCreated($teamId, $club, $teamName, $season)
        );

        return $team;
    }

    /**
     * @param TeamWasCreated $event
     */
    public function applyTeamWasCreated(TeamWasCreated $event)
    {
        $this->teamId = $event->getTeamId();

        $this->information = new TeamInformation(
            $event->getClub(),
            $event->getTeam(),
            $event->getSeason()
        );
    }

    /**
     * @param string $emailAddress
     * @param string $firstName
     * @param string $lastName
     */
    public function addPlayerToTheTeam(string $emailAddress, string $firstName, string $lastName)
    {
        if ($this->players && $this->players->containsKey($emailAddress)) {
            throw new \InvalidArgumentException(sprintf('The email address: %s is already in use', $emailAddress));
        }

        $playerExistsFilter = self::getPlayerExistsFilter($firstName, $lastName);

        if ($this->players && $this->players->filter($playerExistsFilter)->count() > 0) {
            throw new \InvalidArgumentException(
                sprintf('The combination of first and last name: %s %s is already in use', $firstName, $lastName)
            );
        }

        $this->apply(new PlayerJoinsTheTeam($this->teamId, $emailAddress, $firstName, $lastName));
    }

    /**
     * @param PlayerJoinsTheTeam $event
     */
    public function applyPlayerJoinsTheTeam(PlayerJoinsTheTeam $event)
    {
        $player = Player::create(
            $event->getEmailAddress(),
            $event->getFirstName(),
            $event->getLastName()
        );

        $this->players = $this->players ?? new ArrayCollection();
        $this->players->set($event->getEmailAddress(), $player);
    }

    /**
     * @param string $emailAddress
     */
    public function removePlayerFromTheTeam(string $emailAddress)
    {
        if (! $this->players->containsKey($emailAddress)) {
            return;
        }

        $this->apply(new PlayerLeavesTheTeam($this->teamId, $emailAddress));
    }

    /**
     * @param PlayerLeavesTheTeam $event
     */
    public function applyPlayerLeavesTheTeam(PlayerLeavesTheTeam $event)
    {
        $this->players->remove($event->getEmailAddress());
    }

    /**
     * @param int $matchId
     * @param \DateTime $kickOff
     * @param Opponent $opponent
     */
    public function scheduleMatch(int $matchId, \DateTime $kickOff, Opponent $opponent)
    {
        if ($this->matches && $this->matches->containsKey($matchId)) {
            throw new \InvalidArgumentException(sprintf('A match with id: %s was already scheduled', $matchId));
        }

        $this->apply(new MatchWasScheduled($this->teamId, $matchId, $kickOff, $opponent));
    }

    /**
     * @param MatchWasScheduled $event
     */
    public function applyMatchWasScheduled(MatchWasScheduled $event)
    {
        $this->matches = $this->matches ?? new ArrayCollection;

        $this->matches->set(
            $event->getMatchId(),
            new Match($event->getMatchId(), $event->getOpponent(), $event->getKickOff())
        );
    }

    /**
     * @return Player[]
     */
    public function getChildEntities(): array
    {
        return [
            'players' => $this->players ? $this->players->toArray(): [],
            'matches' => $this->matches ? $this->matches->toArray(): [],
        ];
    }

    public function getAggregateRootId()
    {
        return $this->teamId;
    }

    /**
     * @param string $firstName
     * @param string $lastName
     *
     * @return \Closure
     */
    private static function getPlayerExistsFilter(string $firstName, string $lastName): \Closure
    {
        return function (Player $player) use ($firstName, $lastName) : bool {
            $name = $player->getName();

            return $firstName === $name->getFirstName() && $lastName === $name->getLastName();
        };
    }
}
