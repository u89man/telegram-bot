<?php

namespace U89Man\TBot\Entities\Media;

use U89Man\TBot\Entities\MessageEntity;
use U89Man\TBot\Utils;

/**
 * @link https://core.telegram.org/bots/api#inputmediaphoto
 *
 * @method               string getType()
 * @method               string getMedia()
 * @method          string|null getCaption()
 * @method          string|null getParseMode()
 * @method MessageEntity[]|null getCaptionEntities()
 *
 * @method                $this setType(string $type)
 * @method                $this setMedia(string $media)
 * @method                $this setCaption(string $caption)
 * @method                $this setParseMode(string $parseMode)
 * @method                $this setCaptionEntities(MessageEntity[] $captionEntities)
 */
class InputMediaPhoto extends InputMedia
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
     * @param string|null $caption
     * @param string|null $parseMode
     * @param MessageEntity[]|null $captionEntities
     *
     * @return $this
     */
    public static function make(
        $media,
        $caption = null,
        $parseMode = null,
        $captionEntities = null
    ) {
        return new static([
            'type' => self::TYPE_PHOTO,
            'media' => $media,
            'caption' => $caption,
            'parse_mode' => $parseMode,
            'caption_entities' => Utils::toJsonOrNull($captionEntities)
        ]);
    }
}
