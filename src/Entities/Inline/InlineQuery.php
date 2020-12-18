<?php

namespace U89Man\TBot\Entities\Inline;

use U89Man\TBot\Entities\Entity;
use U89Man\TBot\Entities\Location;
use U89Man\TBot\Entities\User;

/**
 * @link https://core.telegram.org/bots/api#inlinequery
 *
 * @method        string getId()
 * @method          User getFrom()
 * @method Location|null getLocation()
 * @method        string getQuery()
 * @method        string getOffset()
 */
class InlineQuery extends Entity
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
