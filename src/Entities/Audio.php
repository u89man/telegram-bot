<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#audio
 *
 * @method         string getFileId()
 * @method         string getFileUniqueId()
 * @method            int getDuration()
 * @method    string|null getPerformer()
 * @method    string|null getTitle()
 * @method    string|null getFileName()
 * @method    string|null getMimeType()
 * @method       int|null getFileSize()
 * @method PhotoSize|null getThumb()
 */
class Audio extends Entity
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
