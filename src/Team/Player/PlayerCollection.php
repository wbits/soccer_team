<?php

namespace Wbits\SoccerTeam\Team\Player;

use Doctrine\Common\Collections\ArrayCollection;

class PlayerCollection extends ArrayCollection
{
    /**
     * @param string $firstName
     * @param string $lastName
     *
     * @return PlayerCollection
     */
    public function filterByName(string $firstName, string $lastName): PlayerCollection
    {
        return $this->filter(self::filterByNameCallback($firstName, $lastName));
    }

    /**
     * @param string $firstName
     * @param string $lastName
     *
     * @return callable
     */
    private static function filterByNameCallback(string $firstName, string $lastName): callable
    {
        return function (Player $player) use ($firstName, $lastName): bool {
            $name = $player->getNickname();
            return $firstName === $name->getNickname() && $lastName === $name->getLastName();
        };
    }
}
