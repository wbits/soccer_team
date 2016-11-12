<?php

namespace Wbits\SoccerTeam\Serializer;

use Assert\Assertion as Assert;
use Wbits\SoccerTeam\Team\TeamInformation;

class TeamInformationSerializer
{
    public static function serialize(TeamInformation $information)
    {
        return [
            'club'   => $information->getClub(),
            'team'   => $information->getTeam(),
            'season' => $information->getSeason(),
        ];
    }

    public static function deserialize(array $data): TeamInformation
    {
        Assert::keyIsset($data, 'club');
        Assert::keyIsset($data, 'team');
        Assert::keyIsset($data, 'season');

        return new TeamInformation(
            $data['club'],
            $data['team'],
            $data['season']
        );
    }
}
