<?php

namespace Wbits\SoccerTeam\Team\Player;

use Doctrine\Common\Collections\ArrayCollection;
use Wbits\SoccerTeam\Exception\ValidationException;

class PlayerCollection extends ArrayCollection
{
    /**
     * @param Player $player
     *
     * @return bool
     * @throws ValidationException
     */
    public function validateNewPlayer(Player $player): bool
    {
        $emailAddress = (string) $player->getEmail();
        $nickname     = (string) $player->getNickname();

        if ($this->containsKey($emailAddress)) {
            throw new ValidationException(sprintf('email exists:', $emailAddress));
        }

        if ($this->filterByNickname($nickname)->count() > 0) {
            throw new ValidationException(sprintf('name not unique: %s', $nickname));
        }

        return true;
    }

    public function addPlayer(Player $player)
    {
        $email  = (string) $player->getEmail();

        $this->set($email, $player);
    }

    /**
     * @param string $nickname
     *
     * @return PlayerCollection
     */
    public function filterByNickname(string $nickname): PlayerCollection
    {
        return $this->filter(self::filterByNicknameCallback($nickname));
    }

    /**
     * @param string $nickname
     *
     * @return callable
     */
    private static function filterByNicknameCallback(string $nickname): callable
    {
        return function (Player $player) use ($nickname): bool {
            return $nickname === (string) $player->getNickname();
        };
    }
}
