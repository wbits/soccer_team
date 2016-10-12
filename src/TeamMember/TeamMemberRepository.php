<?php

namespace Wbits\SoccerTeam\TeamMember;

use Broadway\EventHandling\EventBusInterface;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStoreInterface;

class TeamMemberRepository extends EventSourcingRepository
{
    public function __construct(EventStoreInterface $eventStore, EventBusInterface $eventBus)
    {
        parent::__construct($eventStore, $eventBus, 'TeamMember', new PublicConstructorAggregateFactory());
    }
}
