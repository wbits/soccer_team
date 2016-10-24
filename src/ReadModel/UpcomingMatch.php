<?php

namespace Wbits\SoccerTeam\ReadModel;

use Broadway\ReadModel\ReadModelInterface;
use Broadway\Serializer\SerializableInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Wbits\SoccerTeam\Factory\MatchFactory;
use Wbits\SoccerTeam\Team\Match\Match;

class UpcomingMatch implements ReadModelInterface, SerializableInterface
{
    /**
     * @var string
     */
    public $teamId;

    /**
     * @var Match
     */
    public $upcomingMatch;

    /**
     * @param string $teamId
     */
    public function construct(string $teamId)
    {
        $this->teamId = $teamId;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->teamId;
    }

    /**
     * @param ArrayCollection $matches
     */
    public function setUpcomingMatch(ArrayCollection $matches)
    {
        $this->upcomingMatch = $matches->filter(function (Match $match) {
            return $match->isUpcoming();
        })->first();
    }

    /**
     * @param array $data
     *
     * @return UpcomingMatch
     */
    public static function deserialize(array $data): UpcomingMatch
    {
        $upcomingMatch = new self($data['teamId']);
        $upcomingMatch->upcomingMatch = MatchFactory::create($data);

        return $upcomingMatch;
    }

    /**
     * @return array
     */
    public function serialize()
    {
        $opponent = $this->upcomingMatch->getOpponent();
        $address  = $opponent->getAddress();

        return [
            'teamId'   => $this->teamId,
            'match_id' => $this->upcomingMatch->getMatchId(),
            'kickoff'  => $this->upcomingMatch->getKickOff()->format(DATE_ISO8601),
            'opponent' => [
                'club' => $opponent->getClub(),
                'team' => $opponent->getTeam(),
                'address' => [
                    'street'       => $address->getStreetName(),
                    'house_number' => $address->getHouseNumber(),
                    'postal_code'  => $address->getPostalCode(),
                    'city'         => $address->getCity(),
                ]
            ]
        ];
    }
}
