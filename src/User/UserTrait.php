<?php

namespace Wbits\SoccerTeam\User;

trait UserTrait
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @return User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    public function isAppUser(): bool
    {
        return isset($this->user);
    }
}
