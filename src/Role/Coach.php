<?php

namespace Wbits\SoccerTeam\Role;

use Doctrine\Common\Collections\ArrayCollection;
use Wbits\SoccerTeam\Profile\ProfileTrait;
use Wbits\SoccerTeam\User\UserTrait;

class Coach implements RoleInterface
{
    use ProfileTrait;
    use UserTrait;
    use ChildrenTrait;

    public function __construct()
    {
        $this->children         = new ArrayCollection();
        $this->telephoneNumbers = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function roleName(): string
    {
        return Roles::ROLE_COACH;
    }
}
