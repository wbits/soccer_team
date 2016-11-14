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
            'kickoff'  => $match->getKickoff()->format(DATE_ISO8601),
            'opponent' => self::serializeOpponent($match->getOpponent()),
            'result'   => $serializedResult,
            'upcoming' => $match->isUpcoming(),
        ];
    }

    public static function serializeOpponent(Opponent $opponent): array
    {
        return [
            'club'    => $opponent->getClub(),
            'team'    => $opponent->getTeam(),
            'address' => self::serializeAddress($opponent->getAddress()),
        ];
    }

    public static function serializeAddress(Address $address): array
    {
        return [
            'street'       => $address->getStreetName(),
            'house_number' => $address->getHouseNumber(),
            'postal_code'  => $address->getPostalCode(),
            'city'         => $address->getCity(),
        ];
    }

    public static function deserialize(array $properties): Match
    {
        self::validateMatchProperties($properties);

        return new Match(
            $properties['match_id'],
            self::deserializeOpponent($properties['opponent']),
            new \DateTime($properties['kickoff'])
        );
    }

    public static function deserializeOpponent(array $properties): Opponent
    {
        self::validateOpponent($properties);

        return new Opponent(
            $properties['club'],
            $properties['team'],
            self::deserializeAddress($properties['address'])
        );
    }

    public static function deserializeAddress(array $properties): Address
    {
        self::validateAddress($properties);

        return new Address(
            $properties['street'],
            $properties['house_number'],
            $properties['postal_code'],
            $properties['city']
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
