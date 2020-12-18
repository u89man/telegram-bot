<?php

namespace U89Man\TBot\Entities\Inline\QueryResult;

use U89Man\TBot\Entities\Inline\Content\InputMessageContent;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup;
use U89Man\TBot\Entities\MessageEntity;

/**
 * @link https://core.telegram.org/bots/api#inlinequeryresultmpeg4gif
 *
 * @method                    string getType()
 * @method                    string getId()
 * @method                    string getMpeg4Url()
 * @method                  int|null getMpeg4Width()
 * @method                  int|null getMpeg4Height()
 * @method                  int|null getMpeg4Duration()
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
 * @method                     $this setMpeg4Url(string $mpeg4Url)
 * @method                     $this setMpeg4Width(int $mpeg4Width)
 * @method                     $this setMpeg4Height(int $mpeg4Height)
 * @method                     $this setMpeg4Duration(int $mpeg4Duration)
 * @method                     $this setThumbUrl(string $thumbUrl)
 * @method                     $this setThumbMimeType(string $thumbMimeType)
 * @method                     $this setTitle(string $title)
 * @method                     $this setCaption(string $caption)
 * @method                     $this setParseMode(string $parseMode)
 * @method                     $this setCaptionEntities(MessageEntity[] $captionEntities)
 * @method                     $this setReplyMarkup(InlineKeyboardMarkup $replyMarkup)
 * @method                     $this setInputMessageContent(InputMessageContent $inputMessageContent)
 */
class InlineQueryResultMpeg4Gif extends InlineQueryResult
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
     * @param string $mpeg4Url
     * @param string $thumbUrl
     * @param string|null $thumbMimeType
     * @param int|null $mpeg4Width
     * @param int|null $mpeg4Height
     * @param int|null $mpeg4Duration
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
		$mpeg4Url,
		$thumbUrl,
		$mpeg4Width = null,
		$mpeg4Height = null,
		$mpeg4Duration = null,
        $thumbMimeType = null,
		$title = null,
		$caption = null,
		$parseMode = null,
        $captionEntities = null,
		$replyMarkup = null,
		$inputMessageContent = null
	) {
		return new static([
			'type' => self::TYPE_MPEG4_GIF,
			'id' => $id,
			'mpeg4_url' => $mpeg4Url,
            'mpeg4_width' => $mpeg4Width,
            'mpeg4_height' => $mpeg4Height,
            'mpeg4_duration' => $mpeg4Duration,
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
