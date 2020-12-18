<?php

namespace U89Man\TBot\Entities\Media;

use U89Man\TBot\Entities\InputFile;
use U89Man\TBot\Entities\MessageEntity;
use U89Man\TBot\Utils;

/**
 * @link https://core.telegram.org/bots/api#inputmediadocument
 *
 * @method                string getType()
 * @method                string getMedia()
 * @method string|InputFile|null getThumb()
 * @method           string|null getCaption()
 * @method           string|null getParseMode()
 * @method  MessageEntity[]|null getCaptionEntities()
 * @method             bool|null getDisableContentTypeDetection()
 *
 * @method                 $this setType(string $type)
 * @method                 $this setMedia(string $media)
 * @method                 $this setThumb(string|InputFile $thumb)
 * @method                 $this setCaption(string $caption)
 * @method                 $this setParseMode(string $parseMode)
 * @method                 $this setCaptionEntities(MessageEntity[] $captionEntities)
 * @method                 $this setDisableContentTypeDetection(bool $disableContentTypeDetection)
 */
class InputMediaDocument extends InputMedia
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'caption_entities' => [MessageEntity::class]
        ];
    }

    /**
     * @param string $media
     * @param string|InputFile|null $thumb
     * @param string|null $caption
     * @param string|null $parseMode
     * @param MessageEntity[]|null $captionEntities
     * @param bool|null $disableContentTypeDetection
     *
     * @return $this
     */
    public static function make(
        $media,
        $thumb = null,
        $caption = null,
        $parseMode = null,
        $captionEntities = null,
        $disableContentTypeDetection = null
    ) {
        return new static([
            'type' => self::TYPE_DOCUMENT,
            'media' => $media,
            'thumb' => $thumb,
            'caption' => $caption,
            'parse_mode' => $parseMode,
            'caption_entities' => Utils::toJsonOrNull($captionEntities),
            'disable_content_type_detection' => $disableContentTypeDetection
        ]);
    }
}
