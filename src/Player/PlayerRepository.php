<?php

namespace Wbits\SoccerTeam\Player;

use Broadway\EventHandling\EventBusInterface;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStoreInterface;

class PlayerRepository extends EventSourcingRepository
{
    public function __construct(EventStoreInterface $eventStore, EventBusInterface $eventBus)
    {
        parent::__construct($eventStore, $eventBus, Player::class, new PublicConstructorAggregateFactory());
    }
}
