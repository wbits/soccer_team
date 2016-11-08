<?php

namespace spec\Wbits\SoccerTeam\Serializer;

use Wbits\SoccerTeam\Serializer\MatchSerializer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Wbits\SoccerTeam\Team\Match\Match;
use Wbits\SoccerTeam\Team\Match\Opponent;
use Wbits\SoccerTeam\Team\Property\Address;

class MatchSerializerSpec extends ObjectBehavior
{
    const MATCH_ID                      = '123456';
    const KICKOFF                       = '2016-12-08T11:30:00+0200';
    const OPPONENT_CLUB                 = 'ajax';
    const OPPONENT_TEAM                 =  '1';
    const OPPONENT_ADDRESS_STREET_NAME  = 'street';
    const OPPONENT_ADDRESS_HOUSE_NUMBER = 13;
    const OPPONENT_ADDRESS_POSTAL_CODE  = '1234AB';
    const OPPONENT_ADDRESS_CITY         = 'city';

    function it_is_initializable()
    {
        $this->shouldHaveType(MatchSerializer::class);
    }

    function it_should_serialize_a_match_object_into_an_array()
    {
        $match = $this->getDeserialized();

        $result = $this->serialize($match);
        $result->shouldEqual($this->getSerialized());
    }

    function it_should_deserialize_an_array_into_an_object()
    {
        $array = $this->getSerialized();

        $result = $this->deserialize($array);
        $result->getMatchId()->shouldEqual(self::MATCH_ID);
        $result->getOpponent()->getClub()->shouldEqual(self::OPPONENT_CLUB);
        $result->getOpponent()->getTeam()->shouldEqual(self::OPPONENT_TEAM);
        $result->getOpponent()->getAddress()->getStreetName()->shouldEqual(self::OPPONENT_ADDRESS_STREET_NAME);
        $result->getOpponent()->getAddress()->getHouseNumber()->shouldEqual(self::OPPONENT_ADDRESS_HOUSE_NUMBER);
        $result->getOpponent()->getAddress()->getPostalCode()->shouldEqual(self::OPPONENT_ADDRESS_POSTAL_CODE);
        $result->getOpponent()->getAddress()->getCity()->shouldEqual(self::OPPONENT_ADDRESS_CITY);

        $this->serialize($result)->shouldEqual($this->getSerialized());
    }

    private function getDeserialized()
    {
        $address = new Address(
            self::OPPONENT_ADDRESS_STREET_NAME,
            self::OPPONENT_ADDRESS_HOUSE_NUMBER,
            self::OPPONENT_ADDRESS_POSTAL_CODE,
            self::OPPONENT_ADDRESS_CITY
        );

        $opponent = new Opponent(
            self::OPPONENT_CLUB,
            self::OPPONENT_TEAM,
            $address
        );

        return new Match(
            self::MATCH_ID,
            $opponent,
            new \DateTime(self::KICKOFF)
        );
    }

    private function getSerialized()
    {
        return [
            'match_id' => self::MATCH_ID,
            'kickoff'  => self::KICKOFF,
            'opponent' => [
                'club' => self::OPPONENT_CLUB,
                'team' => self::OPPONENT_TEAM,
                'address' => [
                    'street'       => self::OPPONENT_ADDRESS_STREET_NAME,
                    'house_number' => self::OPPONENT_ADDRESS_HOUSE_NUMBER,
                    'postal_code'  => self::OPPONENT_ADDRESS_POSTAL_CODE,
                    'city'         => self::OPPONENT_ADDRESS_CITY,
                ]
            ],
            'result' => [
                'score'  => '',
                'is_win' => false,
            ],
            'upcoming' => false
        ];
    }


}
