<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#document
 *
 * @method         string getFileId()
 * @method         string getFileUniqueId()
 * @method PhotoSize|null getThumb()
 * @method    string|null getFileName()
 * @method    string|null getMimeType()
 * @method       int|null getFileSize()
 */
class Document extends Entity
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
