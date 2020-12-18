<?php

namespace U89Man\TBot\Entities\Poll;

use U89Man\TBot\Entities\Entity;
use U89Man\TBot\Entities\User;

/**
 * @link https://core.telegram.org/bots/api#pollanswer
 *
 * @method string getPollId()
 * @method   User getUser()
 * @method  int[] getOptionIds()
 */
class PollAnswer extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'user' => User::class
        ];
    }
}
