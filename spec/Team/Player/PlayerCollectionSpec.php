<?php

namespace spec\Wbits\SoccerTeam\Team\Player;

use Wbits\SoccerTeam\Team\Player\Player;
use Wbits\SoccerTeam\Team\Player\PlayerCollection;
use PhpSpec\ObjectBehavior;
use Wbits\SoccerTeam\Team\Property\Nickname;

class PlayerCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PlayerCollection::class);
    }

    function it_should_filter_by_name(Player $one, Player $two)
    {
        $nameOne = new Nickname('foo', 'bar');
        $nameTwo = new Nickname('zoo', 'baz');

        $one->getName()->willReturn($nameOne);
        $two->getName()->willReturn($nameTwo);

        $this->add($one);
        $this->add($two);

        $result = $this->filterByName('foo', 'bar');
        $result->count()->shouldEqual(1);
        $result->first()->shouldEqual($one);
    }
}
