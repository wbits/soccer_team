<?php

namespace Wbits\SoccerTeam\Role;

use Doctrine\Common\Collections\ArrayCollection;
use Wbits\SoccerTeam\Profile\ProfileTrait;
use Wbits\SoccerTeam\User\UserTrait;

class SoccerParent implements RoleInterface
{
    use UserTrait;
    use ChildrenTrait;
    use ProfileTrait;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->telephoneNumbers = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function roleName(): string
    {
        return Roles::ROLE_SOCCER_PARENT;
    }
}
