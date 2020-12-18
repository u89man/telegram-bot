<?php

namespace U89Man\TBot\Entities\Stickers;

use U89Man\TBot\Entities\Entity;
use U89Man\TBot\Entities\PhotoSize;

/**
 * @link https://core.telegram.org/bots/api#stickerset
 *
 * @method    string getName()
 * @method    string getTitle()
 * @method      bool getIsAnimated()
 * @method      bool getContainsMasks()
 * @method Sticker[] getStickers()
 * @method PhotoSize getThumb()
 */
class StickerSet extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'stickers' => [Sticker::class],
            'thumb' => PhotoSize::class
        ];
    }
}
