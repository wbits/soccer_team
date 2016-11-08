<?php

namespace spec\Wbits\SoccerTeam\ReadModel;

use Doctrine\Common\Collections\ArrayCollection;
use Wbits\SoccerTeam\ReadModel\Matches;
use PhpSpec\ObjectBehavior;
use Wbits\SoccerTeam\Team\Match\Match;
use Wbits\SoccerTeam\Team\Match\Opponent;
use Wbits\SoccerTeam\Team\Property\Address;

class MatchesSpec extends ObjectBehavior
{
    const TEAM_ID                       = 'foo';
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
        $this->shouldHaveType(Matches::class);
    }

    function let()
    {
        $this->beConstructedWith(self::TEAM_ID);
    }

    function it_should_serialize()
    {
        $this->addMatch($this->createMatch());
        $result = $this->serialize();
        $result->shouldEqual([
            'teamId' => self::TEAM_ID,
            'matches' => [
                $this->getSerializedMatch(),
            ],
        ]);
    }

    function it_should_deserialize()
    {
        $data = [
            'teamId' => self::TEAM_ID,
            'matches' => [
                $this->getSerializedMatch(),
            ],
        ];

        $result = $this->deserialize($data);
        $result->getId()->shouldEqual(self::TEAM_ID);
        $result->matches->shouldBeAnInstanceOf(ArrayCollection::class);
        $result->shouldBeAnInstanceOf(Matches::class);
    }

    private function createMatch()
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

    private function getSerializedMatch()
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
