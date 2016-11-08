<?php

namespace Wbits\SoccerTeam\ReadModel;

use Broadway\ReadModel\ReadModelInterface;
use Broadway\Serializer\SerializableInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Wbits\SoccerTeam\Serializer\MatchSerializer;
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
    public function addMatch(Match $match)
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
        $matchList = array_map(
            [MatchSerializer::class, 'deserialize'],
            $data['matches']
        );

        $matches = new self($data['teamId']);
        $matches->matches = new ArrayCollection($matchList);

        return $matches;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'teamId'  => $this->teamId,
            'matches' => $this->matches ? array_map(
                [MatchSerializer::class, 'serialize'],
                $this->matches->toArray()
            ) : [],
        ];
    }
}
