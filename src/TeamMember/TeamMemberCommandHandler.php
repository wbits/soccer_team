<?php

namespace Wbits\SoccerTeam\TeamMember;

use Broadway\CommandHandling\CommandHandler;
use Wbits\SoccerTeam\TeamMember\Command\JoinTheTeam;

class TeamMemberCommandHandler extends CommandHandler
{
    /**
     * @var TeamMemberRepository
     */
    private $repository;

    /**
     * @param TeamMemberRepository $repository
     */
    public function __construct(TeamMemberRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param JoinTheTeam $command
     */
    protected function handleJoinTheTeam(JoinTheTeam $command)
    {
        $teamMember = TeamMember::joinTheTeam(
            $command->getMemberId(),
            $command->getName()
        );

        $this->repository->save($teamMember);
    }
}
