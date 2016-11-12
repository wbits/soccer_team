<?php

namespace Wbits\SoccerTeam\Team\Match;

use Broadway\EventSourcing\EventSourcedEntity;
use Wbits\SoccerTeam\Team\Player\PlayerCollection;
use Wbits\SoccerTeam\Team\Player\PlayerInterface;
use Wbits\SoccerTeam\Team\Player\SubmittedAvailabilityForMatch;

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
    private $playersAvailable;

    /**
     * @var PlayerCollection
     */
    private $playersUnavailableConfirmed;

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
    public function getPlayersAvailable(): PlayerCollection
    {
        if (is_null($this->playersAvailable)) {
            $this->playersAvailable = new PlayerCollection();
        }

        return $this->playersAvailable;
    }

    /**
     * @param PlayerInterface | SubmittedAvailabilityForMatch $player
     *
     * @return Match
     */
    public function addPlayerAvailable(PlayerInterface $player): Match
    {
        $this->playersAvailable[] = $player;
    }
}
