<?php

namespace spec\Wbits\SoccerTeam\Serializer;

use Wbits\SoccerTeam\Serializer\MatchWasScheduledSerializer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Wbits\SoccerTeam\Team\Event\MatchWasScheduled;
use Wbits\SoccerTeam\Team\Match\Opponent;
use Wbits\SoccerTeam\Team\Property\Address;
use Wbits\SoccerTeam\Team\TeamId;

class MatchWasScheduledSerializerSpec extends ObjectBehavior
{
    const TEAM_ID                       = 'be50a278-cf0a-458e-b8ac-865e7469a51a';
    const MATCH_ID                      = 123456;
    const KICKOFF                       = '2016-12-08T11:30:00+0200';
    const OPPONENT_CLUB                 = 'ajax';
    const OPPONENT_TEAM                 =  '1';
    const OPPONENT_ADDRESS_STREET_NAME  = 'street';
    const OPPONENT_ADDRESS_HOUSE_NUMBER = 13;
    const OPPONENT_ADDRESS_POSTAL_CODE  = '1234AB';
    const OPPONENT_ADDRESS_CITY         = 'city';

    function it_is_initializable()
    {
        $this->shouldHaveType(MatchWasScheduledSerializer::class);
    }

    function it_should_serialize()
    {
        $result = $this->serialize($this->createMatchWasScheduled());
        $result->shouldEqual($this->getSerialized());
    }

    function it_should_deserialize()
    {
        $result = $this->deserialize($this->getSerialized());
        $result->shouldBeAnInstanceOf(MatchWasScheduled::class);
        $result->getTeamId()->__toString()->shouldEqual(self::TEAM_ID);
        $result->getMatchId()->shouldEqual(self::MATCH_ID);
        $result->getKickOff()->format(DATE_ISO8601)->shouldEqual(self::KICKOFF);
        $result->getOpponent()->shouldReturnAnInstanceOf(Opponent::class);
        $result->getOpponent()->getClub()->shouldEqual(self::OPPONENT_CLUB);
        $result->getOpponent()->getTeam()->shouldEqual(self::OPPONENT_TEAM);
        $result->getOpponent()->getAddress()->shouldReturnAnInstanceOf(Address::class);
        $result->getOpponent()->getAddress()->getStreetName()->shouldReturn(self::OPPONENT_ADDRESS_STREET_NAME);
        $result->getOpponent()->getAddress()->getHouseNumber()->shouldReturn(self::OPPONENT_ADDRESS_HOUSE_NUMBER);
        $result->getOpponent()->getAddress()->getPostalCode()->shouldReturn(self::OPPONENT_ADDRESS_POSTAL_CODE);
        $result->getOpponent()->getAddress()->getCity()->shouldReturn(self::OPPONENT_ADDRESS_CITY);
    }

    private function getSerialized(): array
    {
        return [
            'team_id'  => self::TEAM_ID,
            'match_id' => self::MATCH_ID,
            'kickoff'  => self::KICKOFF,
            'opponent' => [
                'club' => self::OPPONENT_CLUB,
                'team' => self::OPPONENT_TEAM,
                'address' => [
                    'street_name' => self::OPPONENT_ADDRESS_STREET_NAME,
                    'house_number' => self::OPPONENT_ADDRESS_HOUSE_NUMBER,
                    'postal_code' => self::OPPONENT_ADDRESS_POSTAL_CODE,
                    'city' => self::OPPONENT_ADDRESS_CITY,
                ],
            ],
        ];
    }

    private function createMatchWasScheduled(): MatchWasScheduled
    {
        return new MatchWasScheduled(
            new TeamId(self::TEAM_ID),
            self::MATCH_ID,
            new \DateTime(self::KICKOFF),
            new Opponent(
                self::OPPONENT_CLUB,
                self::OPPONENT_TEAM,
                new Address(
                    self::OPPONENT_ADDRESS_STREET_NAME,
                    self::OPPONENT_ADDRESS_HOUSE_NUMBER,
                    self::OPPONENT_ADDRESS_POSTAL_CODE,
                    self::OPPONENT_ADDRESS_CITY
                )
            )
        );
    }
}
