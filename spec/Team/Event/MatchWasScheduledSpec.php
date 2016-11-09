<?php

namespace spec\Wbits\SoccerTeam\Team\Event;

use Broadway\Serializer\SerializableInterface;
use Wbits\SoccerTeam\Team\Event\MatchWasScheduled;
use PhpSpec\ObjectBehavior;
use Wbits\SoccerTeam\Team\Match\Opponent;
use Wbits\SoccerTeam\Team\Property\Address;
use Wbits\SoccerTeam\Team\TeamId;

class MatchWasScheduledSpec extends ObjectBehavior
{
    const TEAM_ID = 'be50a278-cf0a-458e-b8ac-865e7469a51a';
    const MATCH_ID = 12345;

    function it_is_initializable()
    {
        $this->shouldHaveType(MatchWasScheduled::class);
        $this->shouldImplement(SerializableInterface::class);
    }

    function let(\DateTime $kickoff, Opponent $opponent, Address $address)
    {
        $opponent->getClub()->willReturn('foo');
        $opponent->getTeam()->willReturn('bar');
        $opponent->getAddress()->willReturn($address);
        $address->getStreetName()->willReturn('zoo');
        $address->getHouseNumber()->willReturn(1);
        $address->getPostalCode()->willReturn('zap');
        $address->getCity()->willReturn('baz');

        $teamId = new TeamId(self::TEAM_ID);
        $this->beConstructedWith($teamId, self::MATCH_ID, $kickoff, $opponent);
    }

    function it_should_serialize()
    {
        $result = $this->serialize();
        $result->shouldBeArray();
    }

    function it_should_deserialize()
    {
        $data = [
            'team_id'  => self::TEAM_ID,
            'match_id' => self::MATCH_ID,
            'kickoff'  => '2016-12-08T11:30:00+0200',
            'opponent' => [
                'club' => 'bar',
                'team' => 'zap',
                'address' => [
                    'street_name' => 'zoo',
                    'house_number' => 'baz',
                    'postal_code' => 'bez',
                    'city' => 'vag',
                ],
            ],
        ];

        $this->deserialize($data)->shouldReturnAnInstanceOf(MatchWasScheduled::class);
    }
}
