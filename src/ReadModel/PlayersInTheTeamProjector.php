

namespace Wbits\SoccerTeam\ReadModel;

use Broadway\ReadModel\Projector;
use Broadway\ReadModel\RepositoryInterface;
use Wbits\SoccerTeam\Team\Event\PlayerJoinsTheTeam;

class PlayersInTheTeamProjector extends Projector
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    protected function applyPlayerJoinsTheTeam(PlayerJoinsTheTeam $event)
    {
        $readModel = $this->getReadModel((string)$event->getTeamId());

        foreach ($event->getPlayers() as $emailAddress => $player) {
            $readModel->addPlayer(
                $emailAddress,
                sprintf('%s %s', $player->getName()->getFirstName(), $player->getName()->getLastName())
            );
        }

        $this->repository->save($readModel);
    }


    private function getReadModel($emailAddress)
    {
        $readModel = $this->repository->find($emailAddress);

            if (null === $readModel) {
            $readModel = new PlayersInTheTeam($emailAddress);
        }

        return $readModel;
    }

}
