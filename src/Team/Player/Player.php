<?php

namespace Wbits\SoccerTeam\Team\Player;

use Broadway\EventSourcing\EventSourcedEntity;

class Player extends EventSourcedEntity implements PlayerInterface
{
    use PlayerTrait;
}
