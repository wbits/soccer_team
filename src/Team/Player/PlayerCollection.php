<?php

namespace Wbits\SoccerTeam\Team\Player;

use Doctrine\Common\Collections\ArrayCollection;

class PlayerCollection extends ArrayCollection
{
    /**
     * @param string $nickname
     *
     * @return PlayerCollection
     */
    public function filterByName(string $nickname): PlayerCollection
    {
        return $this->filter(self::filterByNameCallback($nickname));
    }

    /**
     * @param string $nickname
     *
     * @return callable
     */
    private static function filterByNameCallback(string $nickname): callable
    {
        return function (Player $player) use ($nickname): bool {
            return $nickname === (string) $player->getNickname();
        };
    }
}
