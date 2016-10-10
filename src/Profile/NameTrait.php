<?php

namespace Wbits\SoccerTeam\Profile;

trait NameTrait
{
    /**
     * @var Name
     */
    private $name;

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @param Name $name
     *
     * @return $this
     */
    public function setName(Name $name)
    {
        $this->name = $name;

        return $this;
    }
}
