<?php

namespace Wbits\SoccerTeam\Serializer;

use Wbits\SoccerTeam\Team\Event\MatchWasScheduled;
use Wbits\SoccerTeam\Team\Match\Opponent;
use Wbits\SoccerTeam\Team\Property\Address;
use Wbits\SoccerTeam\Team\TeamId;

class MatchWasScheduledSerializer
{
    public static function serialize(MatchWasScheduled $event): array
    {
        return [
            'team_id'  => (string) $event->getTeamId(),
            'match_id' => $event->getMatchId(),
            'kickoff'  => $event->getKickOff()->format(DATE_ISO8601),
            'opponent' => [
                'club' => $event->getOpponent()->getClub(),
                'team' => $event->getOpponent()->getTeam(),
                'address' => [
                    'street_name' => $event->getOpponent()->getAddress()->getStreetName(),
                    'house_number' => $event->getOpponent()->getAddress()->getHouseNumber(),
                    'postal_code' => $event->getOpponent()->getAddress()->getPostalCode(),
                    'city' => $event->getOpponent()->getAddress()->getCity(),
                ],
            ],
        ];
    }

    public static function deserialize(array $data): MatchWasScheduled
    {
        return new MatchWasScheduled(
            new TeamId($data['team_id']),
            $data['match_id'],
            new \DateTime($data['kickoff']),
            new Opponent(
                $data['opponent']['club'],
                $data['opponent']['team'],
                new Address(
                    $data['opponent']['address']['street_name'],
                    $data['opponent']['address']['house_number'],
                    $data['opponent']['address']['postal_code'],
                    $data['opponent']['address']['city']
                )
            )
        );
    }
}
