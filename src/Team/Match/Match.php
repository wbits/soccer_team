<?php

namespace Wbits\SoccerTeam\Team\Match;

use Broadway\EventSourcing\EventSourcedEntity;

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
    private $kickOff;

    /**
     * @var Result
     */
    private $result;

    /**
     * @var bool
     */
    private $upcoming = false;

    /**
     * @param string $matchId
     * @param Opponent $opponent
     * @param \DateTime $kickOff
     */
    public function __construct(string $matchId, Opponent $opponent, \DateTime $kickOff)
    {
        $this->matchId  = $matchId;
        $this->opponent = $opponent;
        $this->kickOff  = $kickOff;
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
    public function getKickOff(): \DateTime
    {
        return $this->kickOff;
    }

    /**
     * @return Result
     */
    public function getResult(): Result
    {
        return $this->result;
    }

    /**
     * @param Result $result
     *
     * @return Match
     */
    public function setResult(Result $result): Match
    {
        $this->result = $result;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isUpcoming(): bool
    {
        return $this->upcoming;
    }

    /**
     * @param boolean $upcoming
     *
     * @return Match
     */
    public function setUpcoming(bool $upcoming): Match
    {
        $this->upcoming = $upcoming;

        return $this;
    }
}
