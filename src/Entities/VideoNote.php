<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#videonote
 *
 * @method         string getFileId()
 * @method         string getFileUniqueId()
 * @method            int getLength()
 * @method            int getDuration()
 * @method PhotoSize|null getThumb()
 * @method       int|null getFileSize()
 */
class VideoNote extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'thumb' => PhotoSize::class
        ];
    }
}
