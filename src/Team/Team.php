<?php

namespace Wbits\SoccerTeam\Team;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Doctrine\Common\Collections\ArrayCollection;
use Wbits\SoccerTeam\Exception\ValidationException;
use Wbits\SoccerTeam\Team\Event\{MatchWasScheduled, PlayerJoinsTheTeam, PlayerLeavesTheTeam, TeamWasCreated};
use Wbits\SoccerTeam\Team\Match\{Match, Opponent};
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
     * @var ArrayCollection|Match[]
     */
    private $matches;

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
        $player = $event->getPlayer();
        $email  = (string) $player->getEmail();

        $this->getPlayerCollection()->set($email, $player);
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

        $this->setUpcomingMatch();
    }

    /**
     * @return Player[]
     */
    public function getChildEntities(): array
    {
        $players = $this->getPlayerCollection()->toArray();
        $matches = $this->matches ? $this->matches->toArray(): [];

        return $players + $matches;
    }

    public function getAggregateRootId()
    {
        return $this->teamId;
    }

    private function getPlayerCollection(): PlayerCollection
    {
        return $this->players ?? new PlayerCollection();
    }

    private function setUpcomingMatch()
    {
        /** @var Match $match */
        $match = $this->findUpComingMatch(new \DateTime());

        if (is_null($match)) {
            return;
        }

        $match->setUpcoming(true);
    }

    /**
     * @param \DateTime $now
     *
     * @return Match|null
     */
    private function findUpComingMatch(\DateTime $now)
    {
        foreach ($this->matches as $match) {
            $match->setUpcoming(false);
        }

        return array_reduce(
            $this->matches->toArray(),
            self::getUpcomingMatchCallback($now)
        );
    }

    /**
     * @param \DateTime $now
     *
     * @return \Closure
     */
    private static function getUpcomingMatchCallback(\DateTime $now): \Closure
    {
        return function ($previous, Match $current) use ($now) {

            if ($current->getKickOff() < $now) { // game is done
                return $previous;
            }

            if (! $previous instanceof Match) {
                return $current;
            }

            return $current->getKickOff() < $previous->getKickOff() ? $current : $previous;
        };
    }
}
