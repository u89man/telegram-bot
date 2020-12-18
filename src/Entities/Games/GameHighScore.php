<?php

namespace U89Man\TBot\Entities\Games;

use U89Man\TBot\Entities\Entity;
use U89Man\TBot\Entities\User;

/**
 * @link https://core.telegram.org/bots/api#gamehighscore
 *
 * @method  int getPosition()
 * @method User getUser()
 * @method  int getScore()
 */
class GameHighScore extends Entity
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
