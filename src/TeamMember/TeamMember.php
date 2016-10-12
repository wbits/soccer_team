<?php

namespace Wbits\SoccerTeam\TeamMember;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Wbits\SoccerTeam\TeamMember\Event\TeamMemberJoinsTheTeam;
use Wbits\SoccerTeam\TeamMember\Property\Name;
use Wbits\SoccerTeam\TeamMember\Property\TeamMemberId;

class TeamMember extends EventSourcedAggregateRoot
{
    private $memberId;
    private $name;

    public static function joinTheTeam(TeamMemberId $memberId, Name $name): TeamMember
    {
        $teamMember = new TeamMember();
        $teamMember->join($memberId, $name);

        return $teamMember;
    }

    private function join(TeamMemberId $memberId, Name $name)
    {
        $this->apply(new TeamMemberJoinsTheTeam($memberId, $name));
    }

    public function applyTeamJoinsTheTeamEvent(TeamMemberJoinsTheTeam $event)
    {
        $this->memberId = $event->getMemberId();
        $this->name     = $event->getName();
    }

    /**
     * @return string
     */
    public function getAggregateRootId(): string
    {
        return $this->memberId;
    }
}
