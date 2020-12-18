<?php

namespace U89Man\TBot\Entities\Games;

use U89Man\TBot\Entities\Animation;
use U89Man\TBot\Entities\Entity;
use U89Man\TBot\Entities\MessageEntity;
use U89Man\TBot\Entities\PhotoSize;

/**
 * @link https://core.telegram.org/bots/api#game
 *
 * @method               string getTitle()
 * @method               string getDescription()
 * @method          PhotoSize[] getPhoto()
 * @method          string|null getText()
 * @method MessageEntity[]|null getTextEntities()
 * @method       Animation|null getAnimation()
 */
class Game extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'photo' => [PhotoSize::class],
            'text_entities' => [MessageEntity::class],
            'animation' => Animation::class
        ];
    }
}
