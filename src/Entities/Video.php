<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#video
 *
 * @method         string getFileId()
 * @method         string getFileUniqueId()
 * @method            int getWidth()
 * @method            int getHeight()
 * @method            int getDuration()
 * @method PhotoSize|null getThumb()
 * @method    string|null getFileName()
 * @method    string|null getMimeType()
 * @method       int|null getFileSize()
 */
class Video extends Entity
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
