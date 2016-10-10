<?php

namespace Wbits\SoccerTeam\Role;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Doctrine\Common\Collections\ArrayCollection;
use Wbits\SoccerTeam\Event\PlayerJoinsTheTeamEvent;
use Wbits\SoccerTeam\Profile\Name;
use Wbits\SoccerTeam\Profile\NameTrait;
use Wbits\SoccerTeam\User\UserTrait;

class Player extends EventSourcedAggregateRoot implements RoleInterface
{
    use NameTrait;
    use UserTrait;

    /**
     * @var ArrayCollection|SoccerParent[]
     */
    private $parents;

    /**
     * @var string
     */
    private $playerId;

    public function __construct()
    {
        $this->parents = new ArrayCollection();
    }

    /**
     * @param string $playerId
     * @param string $firstName
     * @param string $lastName
     *
     * @return Player
     */
    public static function joinsTheTeam(string $playerId, string $firstName, string $lastName): Player
    {
        $player = new Player();

        $player->apply(new PlayerJoinsTheTeamEvent($playerId, $firstName, $lastName));

        return $player;
    }

    /**
     * @return string
     */
    public function getAggregateRootId(): string
    {
        return $this->playerId;
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
