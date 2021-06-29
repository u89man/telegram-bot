<?php

namespace U89Man\TBot\Entities\Inline\QueryResult;

use U89Man\TBot\Entities\Inline\Content\InputMessageContent;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup;
use U89Man\TBot\Entities\MessageEntity;

/**
 * @link https://core.telegram.org/bots/api#inlinequeryresultphoto
 *
 * @method                    string getType()
 * @method                    string getId()
 * @method                    string getPhotoUrl()
 * @method                    string getThumbUrl()
 * @method                  int|null getPhotoWidth()
 * @method                  int|null getPhotoHeight()
 * @method               string|null getTitle()
 * @method               string|null getDescription()
 * @method               string|null getCaption()
 * @method               string|null getParseMode()
 * @method      MessageEntity[]|null getCaptionEntities()
 * @method InlineKeyboardMarkup|null getReplyMarkup()
 * @method  InputMessageContent|null getInputMessageContent()
 *
 * @method                     $this setType(string $type)
 * @method                     $this setId(string $id)
 * @method                     $this setPhotoUrl(string $photoUrl)
 * @method                     $this setThumbUrl(string $thumbUrl)
 * @method                     $this setPhotoWidth(int $photoWidth)
 * @method                     $this setPhotoHeight(int $photoHeight)
 * @method                     $this setTitle(string $title)
 * @method                     $this setDescription(string $description)
 * @method                     $this setCaption(string $caption)
 * @method                     $this setParseMode(string $parseMode)
 * @method                     $this setCaptionEntities(MessageEntity[] $captionEntities)
 * @method                     $this setReplyMarkup(InlineKeyboardMarkup $replyMarkup)
 * @method                     $this setInputMessageContent(InputMessageContent $inputMessageContent)
 */
class InlineQueryResultPhoto extends InlineQueryResult
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
	 * @param string $photoUrl
	 * @param string $thumbUrl
	 * @param int|null $photoWidth
	 * @param int|null $photoHeight
	 * @param string|null $title
	 * @param string|null $description
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
		$photoUrl,
		$thumbUrl,
		$photoWidth = null,
		$photoHeight = null,
		$title = null,
		$description = null,
		$caption = null,
		$parseMode = null,
        $captionEntities = null,
		$replyMarkup = null,
		$inputMessageContent = null
	) {
		return new static([
			'type' => InlineQueryResult::TYPE_PHOTO,
			'id' => $id,
			'photo_url' => $photoUrl,
			'thumb_url' => $thumbUrl,
			'photo_width' => $photoWidth,
			'photo_height' => $photoHeight,
			'title' => $title,
			'description' => $description,
			'caption' => $caption,
			'parse_mode' => $parseMode,
            'caption_entities' => $captionEntities,
			'reply_markup' => $replyMarkup,
			'input_message_content' => $inputMessageContent
		]);
	}
}
