<?php

namespace Wbits\SoccerTeam\Team\Player;

trait AvailableForMatchTrait
{
    /**
     * @var bool
     */
    private $available;

    /**
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->available;
    }

    /**
     * @param bool $available
     *
     * @return $this
     */
    public function setAvailable(bool $available)
    {
        $this->available = $available;

        return $this;
    }
}
