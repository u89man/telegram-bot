<?php

namespace U89Man\TBot\Entities\Inline;

use U89Man\TBot\Entities\Entity;
use U89Man\TBot\Entities\Location;
use U89Man\TBot\Entities\User;

/**
 * @link https://core.telegram.org/bots/api#choseninlineresult
 *
 * @method        string getResultId()
 * @method          User getFrom()
 * @method Location|null getLocation()
 * @method   string|null getInlineMessageId()
 * @method        string getQuery()
 */
class ChosenInlineResult extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'from' => User::class,
            'location' => Location::class
        ];
    }
}
