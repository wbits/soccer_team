<?php

namespace Wbits\SoccerTeam\Team\Match;

use Broadway\EventSourcing\EventSourcedEntity;
use Wbits\SoccerTeam\Team\Player\Player;
use Wbits\SoccerTeam\Team\Player\PlayerCollection;

class Match extends EventSourcedEntity
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
    private $playersWhoSubmittedAvailabilityForMatch;

    /**
     * @var Result
     */
    private $result;

    /**
     * @var bool
     */
    private $upcoming = false;

    /**
     * @param string    $matchId
     * @param Opponent  $opponent
     * @param \DateTime $kickoff
     */
    public function __construct(string $matchId, Opponent $opponent, \DateTime $kickoff)
    {
        $this->matchId  = $matchId;
        $this->opponent = $opponent;
        $this->kickoff  = $kickoff;
    }

    /**
     * @return string
     */
    public function getMatchId(): string
    {
        return $this->matchId;
    }

    /**
     * @return Opponent
     */
    public function getOpponent(): Opponent
    {
        return $this->opponent;
    }

    /**
     * @return \DateTime
     */
    public function getKickoff(): \DateTime
    {
        return $this->kickoff;
    }

    /**
     * @return Result
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param Result $result
     *
     * @return Match
     */
    public function setResult(Result $result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * @return bool
     */
    public function isUpcoming(): bool
    {
        return $this->upcoming;
    }

    /**
     * @param bool $upcoming
     *
     * @return Match
     */
    public function setUpcoming(bool $upcoming): Match
    {
        $this->upcoming = $upcoming;

        return $this;
    }

    /**
     * @return PlayerCollection
     */
    public function getPlayersWhoSubmittedAvailabilityForMatch(): PlayerCollection
    {
        if (is_null($this->playersWhoSubmittedAvailabilityForMatch)) {
            $this->playersWhoSubmittedAvailabilityForMatch = new PlayerCollection();
        }

        return $this->playersWhoSubmittedAvailabilityForMatch;
    }

    /**
     * @param Player $player
     *
     * @return Match
     */
    public function addPlayerWhoSubmittedAvailabilityForMatch(Player $player): Match
    {
        $this->playersWhoSubmittedAvailabilityForMatch[] = $player;

        return $this;
    }
}
