<?php

namespace Wbits\SoccerTeam\Team\Match;

class Result
{
    /**
     * @var bool
     */
    private $win;

    /**
     * @var string
     */
    private $score;

    /**
     * @param bool $win
     * @param string $score
     */
    public function __construct(bool $win, string $score)
    {
        $this->win   = $win;
        $this->score = $score;
    }

    /**
     * @return boolean
     */
    public function isWin(): bool
    {
        return $this->win;
    }

    /**
     * @return string
     */
    public function getScore(): string
    {
        return $this->score;
    }
}
