<?php

namespace Wbits\SoccerTeam\Team\Player;

class SubmittedAvailabilityForMatch implements PlayerInterface
{
    use PlayerTrait;

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
     * @return SubmittedAvailabilityForMatch
     */
    public function setAvailable(bool $available): SubmittedAvailabilityForMatch
    {
        $this->available = $available;

        return $this;
    }
}
