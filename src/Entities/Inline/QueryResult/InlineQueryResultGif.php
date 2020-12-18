<?php

namespace U89Man\TBot\Entities\Inline\QueryResult;

use U89Man\TBot\Entities\Inline\Content\InputMessageContent;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup;
use U89Man\TBot\Entities\MessageEntity;

/**
 * @link https://core.telegram.org/bots/api#inlinequeryresultgif
 *
 * @method                    string getType()
 * @method                    string getId()
 * @method                    string getGifUrl()
 * @method                  int|null getGifWidth()
 * @method                  int|null getGifHeight()
 * @method                  int|null getGifDuration()
 * @method                    string getThumbUrl()
 * @method               string|null getThumbMimeType()
 * @method               string|null getTitle()
 * @method               string|null getCaption()
 * @method               string|null getParseMode()
 * @method      MessageEntity[]|null getCaptionEntities()
 * @method InlineKeyboardMarkup|null getReplyMarkup()
 * @method  InputMessageContent|null getInputMessageContent()
 *
 * @method                     $this setType(string $type)
 * @method                     $this setId(string $id)
 * @method                     $this setGifUrl(string $gifUrl)
 * @method                     $this setGifWidth(int $gifWidth)
 * @method                     $this setGifHeight(int $gifHeight)
 * @method                     $this setGifDuration(int $gifDuration)
 * @method                     $this setThumbUrl(string $thumbUrl)
 * @method                     $this setThumbMimeType(string $thumbMimeType)
 * @method                     $this setTitle(string $title)
 * @method                     $this setCaption(string $caption)
 * @method                     $this setParseMode(string $parseMode)
 * @method                     $this setCaptionEntities(MessageEntity[] $captionEntities)
 * @method                     $this setReplyMarkup(InlineKeyboardMarkup $replyMarkup)
 * @method                     $this setInputMessageContent(InputMessageContent $inputMessageContent)
 */
class InlineQueryResultGif extends InlineQueryResult
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'caption_entities' => [MessageEntity::class],
            'reply_markup' => InlineKeyboardMarkup::class,
            'input_message_content' => InputMessageContent::class
        ];
    }

    /**
     * @param string $id
     * @param string $gifUrl
     * @param string $thumbUrl
     * @param string|null $thumbMimeType
     * @param int|null $gifWidth
     * @param int|null $gifHeight
     * @param int|null $gifDuration
     * @param string|null $title
     * @param string|null $caption
     * @param string|null $parseMode
     * @param MessageEntity[]|null $captionEntities
     * @param InlineKeyboardMarkup|null $replyMarkup
     * @param InputMessageContent|null $inputMessageContent
     *
     * @return $this
     */
	public static function make(
		$id,
		$gifUrl,
		$thumbUrl,
		$gifWidth = null,
		$gifHeight = null,
		$gifDuration = null,
        $thumbMimeType = null,
		$title = null,
		$caption = null,
		$parseMode = null,
        $captionEntities = null,
		$replyMarkup = null,
		$inputMessageContent = null
	) {
		return new static([
			'type' => self::TYPE_GIF,
			'id' => $id,
			'gif_url' => $gifUrl,
            'gif_width' => $gifWidth,
            'gif_height' => $gifHeight,
            'gif_duration' => $gifDuration,
			'thumb_url' => $thumbUrl,
			'thumb_mime_type' => $thumbMimeType,
			'title' => $title,
			'caption' => $caption,
			'parse_mode' => $parseMode,
            'caption_entities' => $captionEntities,
			'reply_markup' => $replyMarkup,
			'input_message_content' => $inputMessageContent
		]);
	}
}
