<?php

namespace Wbits\SoccerTeam\Team\Match;

use Doctrine\Common\Collections\ArrayCollection;
use Wbits\SoccerTeam\SoccerTeamBundle\Exception\ValidationException;

class Season extends ArrayCollection
{
    public function validateScheduledMatch(Match $match)
    {
        $matchId = $match->getMatchId();
        $errors  = [];

        if ($this->containsKey($match->getMatchId())) {
            $errors['match_id'] = sprintf('A match with id: %s was already scheduled', $matchId);
        }

        if (! empty($errors)) {
            throw (new ValidationException())->setErrors($errors);
        }
    }
}
