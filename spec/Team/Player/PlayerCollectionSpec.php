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
        $nameOne = new Nickname('foo');
        $nameTwo = new Nickname('zoo');

        $one->getNickname()->willReturn($nameOne);
        $two->getNickname()->willReturn($nameTwo);

        $this->add($one);
        $this->add($two);

        $result = $this->filterByNickname('foo');
        $result->count()->shouldEqual(1);
        $result->first()->shouldEqual($one);
    }
}
