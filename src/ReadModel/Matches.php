<?php

namespace Wbits\SoccerTeam\ReadModel;

use Broadway\ReadModel\ReadModelInterface;
use Broadway\Serializer\SerializableInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Wbits\SoccerTeam\Factory\MatchFactory;
use Wbits\SoccerTeam\Team\Match\Match;

class Matches implements ReadModelInterface, SerializableInterface
{
    /**
     * @var string
     */
    public $teamId;

    /**
     * @var Match[]|ArrayCollection
     */
    public $matches;

    /**
     * @param string $teamId
     */
    public function __construct(string $teamId)
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
     * @param Match $match
     */
    public function addMatch($match)
    {
        $this->matches   = $this->matches ?? new ArrayCollection();
        $this->matches[] = $match;
    }

    /**
     * @param array $data
     *
     * @return Matches
     */
    public static function deserialize(array $data): Matches
    {
        $matchList = array_map(function (array $match) {
            MatchFactory::create($match);
        }, $data['matches']);

        $matches = new self($data['teamId']);
        $matches->matches = new ArrayCollection($matchList);

        return $matches;
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return [
            'teamId'  => $this->teamId,
            'matches' => $this->matches ? array_map(self::getSerializationCallback(), $this->matches->toArray()) : [],
        ];
    }

    private static function getSerializationCallback()
    {
        return function ($match) {
            if (! $match instanceof Match) {
                return ['foo' => 'bar'];
            }

            $opponent = $match->getOpponent();
            $address  = $opponent->getAddress();
            return [
                'match_id' => $match->getMatchId(),
                'kickoff'  => $match->getKickOff()->format(DATE_ISO8601),
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
        };
    }
}
