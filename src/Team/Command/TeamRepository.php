<?php

namespace Wbits\SoccerTeam\Team\Command;

use Broadway\EventHandling\EventBusInterface;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStoreInterface;
use Wbits\SoccerTeam\Team\Team;

class TeamRepository extends EventSourcingRepository
{
    public function __construct(EventStoreInterface $eventStore, EventBusInterface $eventBus)
    {
        parent::__construct($eventStore, $eventBus, Team::class, new PublicConstructorAggregateFactory());
    }
}
