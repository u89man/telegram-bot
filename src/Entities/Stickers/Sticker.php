<?php

namespace U89Man\TBot\Entities\Stickers;

use U89Man\TBot\Entities\Entity;
use U89Man\TBot\Entities\PhotoSize;

/**
 * @link https://core.telegram.org/bots/api#sticker
 *
 * @method            string getFileId()
 * @method            string getFileUniqueId()
 * @method               int getWidth()
 * @method               int getHeight()
 * @method              bool getIsAnimated()
 * @method              bool getIsVideo()
 * @method    PhotoSize|null getThumb()
 * @method       string|null getEmoji()
 * @method       string|null getSetName()
 * @method MaskPosition|null getMaskPosition()
 * @method          int|null getFileSize()
 */
class Sticker extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'thumb' => PhotoSize::class,
            'mask_position' => MaskPosition::class
        ];
    }
}
