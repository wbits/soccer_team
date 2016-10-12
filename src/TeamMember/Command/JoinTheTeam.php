<?php

namespace Wbits\SoccerTeam\TeamMember\Command;

use Wbits\SoccerTeam\TeamMember\Property\Name;
use Wbits\SoccerTeam\TeamMember\Property\TeamMemberId;

class JoinTheTeam
{
    private $memberId;
    private $name;

    public function __construct(TeamMemberId $memberId, Name $name)
    {
        $this->memberId = $memberId;
        $this->name     = $name;
    }

    public function getMemberId(): TeamMemberId
    {
        return $this->memberId;
    }

    public function getName(): Name
    {
        return $this->name;
    }
}
