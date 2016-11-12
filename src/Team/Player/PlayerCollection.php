<?php

namespace Wbits\SoccerTeam\Team\Player;

use Doctrine\Common\Collections\ArrayCollection;
use Wbits\SoccerTeam\SoccerTeamBundle\Exception\ValidationException;

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
        $errors = [];
        $emailAddress = (string) $player->getEmail();
        $nickname     = (string) $player->getNickname();

        if ($this->containsKey($emailAddress)) {
            $errors['email'] = sprintf('The provided email address: %s is already in use', $emailAddress);
        }

        if ($this->filterByNickname($nickname)->count() > 0) {
            $errors['nickname'] = sprintf('The nickname: %s is already taken', $nickname);
        }

        if (! empty ($errors)) {
            throw (new ValidationException())->setErrors($errors);
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
