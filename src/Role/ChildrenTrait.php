<?php

namespace Wbits\SoccerTeam\Role;

use Doctrine\Common\Collections\ArrayCollection;

trait ChildrenTrait
{
    /**
     * @var ArrayCollection
     */
    protected $children;

    /**
     * @return ArrayCollection|SoccerParent[]
     */
    public function getChildren(): ArrayCollection
    {
        return $this->children;
    }

    public function addChild(Player $child)
    {
        $this->children[] = $child;

        return $this;
    }

    public function removeChild(Player $child)
    {
        $this->children->removeElement($child);

        return $this;
    }
}
