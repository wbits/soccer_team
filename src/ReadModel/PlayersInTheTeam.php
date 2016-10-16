

namespace Wbits\SoccerTeam\ReadModel;

use Broadway\ReadModel\ReadModelInterface;
use Broadway\Serializer\SerializableInterface;

class PlayersInTheTeam implements ReadModelInterface, SerializableInterface
{
    private $teamId;
    private $players;

    public function __construct($teamId)
    {
        $this->teamId = $teamId;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->teamId;
    }

    public function addPlayer($emailAddress, $playerName)
    {
        $this->players[$emailAddress] = $playerName;
    }

    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        $playersInTheTeam = new self(
            $data['team']
        );

        $playersInTheTeam->players = $data['players'];
        return $playersInTheTeam;
    }

    /**
     * @return array
     */
    public function serialize()
    {
        return [
            'team' => $this->teamId,
            'players' => $this->players,
        ];
    }
}
