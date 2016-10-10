<?php

namespace Wbits\SoccerTeam\User;

use Doctrine\Common\Collections\ArrayCollection;
use Wbits\SoccerTeam\Role\RoleInterface;

class User
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var ArrayCollection|RoleInterface[]
     */
    private $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return ArrayCollection|RoleInterface[]
     */
    public function getRoles(): ArrayCollection
    {
        return $this->roles;
    }

    /**
     * @param RoleInterface $role
     *
     * @return User
     */
    public function addRole(RoleInterface $role): User
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * @param RoleInterface $role
     *
     * @return User
     */
    public function removeRole(RoleInterface $role): User
    {
        $this->roles->removeElement($role);

        return $this;
    }

    /**
     * @param string $roleName
     *
     * @return ArrayCollection
     */
    public function findRole(string $roleName): ArrayCollection
    {
        $filterCallback = function (RoleInterface $role) use ($roleName) {
            return $role->roleName() === $roleName;
        };

        return $this->roles->filter($filterCallback);
    }

    /**
     * @param string $roleName
     *
     * @return bool
     */
    public function hasRole(string $roleName): bool
    {
        return $this->findRole($roleName)->count() > 0;
    }
}
