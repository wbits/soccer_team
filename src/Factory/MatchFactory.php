<?php

namespace Wbits\SoccerTeam\Factory;

use Assert\Assertion as Assert;
use Wbits\SoccerTeam\Team\Match\Match;
use Wbits\SoccerTeam\Team\Match\Opponent;
use Wbits\SoccerTeam\Team\Property\Address;

class MatchFactory
{
    public static function create(array $properties): Match
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
        Assert::keyIsset($address, 'street_name', 'street_name is required in address');
        Assert::keyIsset($address, 'house_number', 'house_number is required in address');
        Assert::keyIsset($address, 'postal_code', 'postal_code is required in address');
        Assert::keyIsset($address, 'city', 'city is required in address');
    }
}
