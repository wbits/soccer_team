<?php

namespace Wbits\SoccerTeam\Role;

use Doctrine\Common\Collections\ArrayCollection;
use Wbits\SoccerTeam\Profile\NameTrait;
use Wbits\SoccerTeam\User\UserTrait;

class Player implements RoleInterface
{
    use NameTrait;
    use UserTrait;

    /**
     * @var ArrayCollection|SoccerParent[]
     */
    private $parents;

    public function __construct()
    {
        $this->parents = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function roleName(): string
    {
        return Roles::ROLE_PLAYER;
    }

    /**
     * @return ArrayCollection|SoccerParent[]
     */
    public function getParents(): ArrayCollection
    {
        return $this->parents;
    }

    /**
     * @param SoccerParent $parent
     *
     * @return Player
     */
    public function addParent(SoccerParent $parent): Player
    {
        $this->parents[] = $parent;

        return $this;
    }

    /**
     * @param SoccerParent $parent
     *
     * @return Player
     */
    public function removeParent(SoccerParent $parent): Player
    {
        $this->parents->removeElement($parent);

        return $this;
    }
}
