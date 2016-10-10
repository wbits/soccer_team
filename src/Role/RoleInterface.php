<?php

namespace Wbits\SoccerTeam\Role;

interface RoleInterface
{
    public function roleName(): string;
    public function isAppUser(): bool;
}
