<?php

namespace spec\Wbits\SoccerTeam\Role;

use Wbits\SoccerTeam\Profile\Name;
use Wbits\SoccerTeam\Role\Player;
use PhpSpec\ObjectBehavior;

class PlayerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Player::class);
    }

    function it_should_create_an_instance_of_player_when_it_joins_the_team()
    {
        $player = $this->joinsTheTeam('foo', 'john', 'doe');

        $player->shouldBeAnInstanceOf(Player::class);
        $player->getAggregateRootId()->shouldEqual('foo');

        $player->getName()->shouldBeAnInstanceOf(Name::class);
        $player->getName()->getFirstName()->shouldEqual('john');
        $player->getName()->getLastName()->shouldEqual('doe');
    }
}
