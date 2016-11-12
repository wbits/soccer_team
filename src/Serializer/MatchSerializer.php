<?php

namespace Wbits\SoccerTeam\Serializer;

use Wbits\SoccerTeam\Team\Match\Match;
use Wbits\SoccerTeam\Team\Match\Opponent;
use Wbits\SoccerTeam\Team\Property\Address;
use Assert\Assertion as Assert;

class MatchSerializer
{
    public static function serialize(Match $match): array
    {
        $opponent = $match->getOpponent();
        $address  = $opponent->getAddress();

        $result           = $match->getResult();
        $serializedResult = [
            'score'  => '',
            'is_win' => false,
        ];

        if (! is_null($result)) {
            $serializedResult['score']  = $result->getScore();
            $serializedResult['is_win'] = $result->isWin();
        }

        return [
            'match_id' => $match->getMatchId(),
            'kickoff'  => $match->getKickOff()->format(DATE_ISO8601),
            'opponent' => [
                'club'    => $opponent->getClub(),
                'team'    => $opponent->getTeam(),
                'address' => [
                    'street'       => $address->getStreetName(),
                    'house_number' => $address->getHouseNumber(),
                    'postal_code'  => $address->getPostalCode(),
                    'city'         => $address->getCity(),
                ],
            ],
            'result'   => $serializedResult,
            'upcoming' => $match->isUpcoming(),
        ];
    }

    public static function deserialize(array $properties): Match
    {
        self::validateMatchProperties($properties);
        self::validateOpponent($properties['opponent']);
        self::validateAddress($properties['opponent']['address']);

        $address = new Address(
            $properties['opponent']['address']['street'],
            $properties['opponent']['address']['house_number'],
            $properties['opponent']['address']['postal_code'],
            $properties['opponent']['address']['city']
        );
        $opponent = new Opponent(
            $properties['opponent']['club'],
            $properties['opponent']['team'],
            $address
        );

        return new Match(
            $properties['match_id'],
            $opponent,
            new \DateTime($properties['kickoff'])
        );
    }

    private static function validateMatchProperties(array $properties)
    {
        Assert::keyIsset($properties, 'match_id', 'match_id was not found');
        Assert::keyIsset($properties, 'opponent', 'opponent was not found');
        Assert::keyIsset($properties, 'kickoff', 'kickoff was not found');
    }

    private static function validateOpponent($opponent)
    {
        Assert::isArray($opponent);
        Assert::keyIsset($opponent, 'club', 'club is required in opponent');
        Assert::keyIsset($opponent, 'team', 'team is required in opponent');
        Assert::keyIsset($opponent, 'address', 'address is required in opponent');
    }

    private static function validateAddress($address)
    {
        Assert::isArray($address);
        Assert::keyIsset($address, 'street', 'street is required in address');
        Assert::keyIsset($address, 'house_number', 'house_number is required in address');
        Assert::keyIsset($address, 'postal_code', 'postal_code is required in address');
        Assert::keyIsset($address, 'city', 'city is required in address');
    }
}
