<?php

namespace Wbits\SoccerTeam\Team\Command;

use Broadway\UuidGenerator\UuidGeneratorInterface;
use Wbits\SoccerTeam\Serializer\MatchSerializer;
use Wbits\SoccerTeam\Serializer\PlayerSerializer;
use Wbits\SoccerTeam\Serializer\TeamInformationSerializer;
use Wbits\SoccerTeam\Team\TeamId;

class TeamCommandFactory
{
    /**
     * @var UuidGeneratorInterface
     */
    private $uuidGenerator;

    /**
     * @param UuidGeneratorInterface $uuidGenerator
     */
    public function __construct(UuidGeneratorInterface $uuidGenerator)
    {
        $this->uuidGenerator = $uuidGenerator;
    }

    /**
     * @param array $params
     *
     * @return CreateNewTeam
     */
    public function createCreateNewTeamCommand(array $params): CreateNewTeam
    {
        $teamId = new TeamId($this->uuidGenerator->generate());

        return new CreateNewTeam(
            $teamId,
            TeamInformationSerializer::deserialize($params)
        );
    }

    /**
     * @param array  $params
     * @param string $teamId
     *
     * @return AddPlayer
     */
    public function createAddPlayerCommand(array $params, string $teamId): AddPlayer
    {
        return new AddPlayer(
            new TeamId($teamId),
            PlayerSerializer::deserialize($params)
        );
    }

    /**
     * @param array  $params
     * @param string $teamId
     *
     * @return RemovePlayer
     */
    public function createRemovePlayerCommand(array $params, string $teamId): RemovePlayer
    {
        return new RemovePlayer(
            new TeamId($teamId),
            PlayerSerializer::deserialize($params)
        );
    }

    /**
     * @param array  $params
     * @param string $teamId
     *
     * @return ScheduleMatch
     */
    public function createScheduleMatchCommand(array $params, string $teamId): ScheduleMatch
    {
        return new ScheduleMatch(
            new TeamId($teamId),
            MatchSerializer::deserialize($params)
        );
    }

    /**
     * @param array $params
     * @param string $teamId
     *
     * @return SubmitAvailabilityForMatch
     */
    public function createSubmitAvailabilityForMatchCommand(array $params, string $teamId): SubmitAvailabilityForMatch
    {
        $player = PlayerSerializer::deserialize($params['player']);
        $player->setAvailable($params['available']);

        $command = new SubmitAvailabilityForMatch(new TeamId($teamId), $player);

        return $command->setMatchId($params['match_id']);
    }
}
