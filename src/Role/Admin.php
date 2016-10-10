<?php

namespace Wbits\SoccerTeam\Role;

class Admin implements RoleInterface
{
    /**
     * @return string
     */
    public function roleName(): string
    {
        return Roles::ROLE_ADMIN;
    }

    /**
     * @return bool
     */
    public function isAppUser(): bool
    {
        return true;
    }
}
