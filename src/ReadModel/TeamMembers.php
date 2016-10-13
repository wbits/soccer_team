<?php

namespace Wbits\SoccerTeam\ReadModel;

use Broadway\ReadModel\ReadModelInterface;
use Broadway\Serializer\SerializableInterface;

class TeamMembers implements ReadModelInterface, SerializableInterface
{
    private $memberId;

    public function __construct($memberId)
    {
        $this->memberId = $memberId;
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->memberId;
    }

    /**
     * {@inheritDoc}
     */
    public function serialize(): array
    {
        return array(
            'purchasedProductId' => $this->memberId,
        );
    }

    /**
     * {@inheritDoc}
     */
    public static function deserialize(array $data): TeamMembers
    {
        $readModel = new self($data['memberId']);

        return $readModel;
    }
}
