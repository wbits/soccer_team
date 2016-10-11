<?php

namespace Wbits\SoccerTeam\SoccerTeamBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class MemberController
{
    public function joinTheTeamAction()
    {
        echo 'member joins the team';
    }

    public function membersAction(): Response
    {
        return new Response('show a list of team members');
    }
}
