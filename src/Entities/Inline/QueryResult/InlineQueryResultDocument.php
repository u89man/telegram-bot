<?php

namespace U89Man\TBot\Entities\Inline\QueryResult;

use U89Man\TBot\Entities\Inline\Content\InputMessageContent;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup;
use U89Man\TBot\Entities\MessageEntity;

/**
 * @link https://core.telegram.org/bots/api#inlinequeryresultdocument
 *
 * @method                    string getType()
 * @method                    string getId()
 * @method                    string getTitle()
 * @method               string|null getCaption()
 * @method               string|null getParseMode()
 * @method      MessageEntity[]|null getCaptionEntities()
 * @method                    string getDocumentUrl()
 * @method                    string getMimeType()
 * @method               string|null getDescription()
 * @method InlineKeyboardMarkup|null getReplyMarkup()
 * @method  InputMessageContent|null getInputMessageContent()
 * @method               string|null getThumbUrl()
 * @method                  int|null getThumbWidth()
 * @method                  int|null getThumbHeight()
 *
 * @method                     $this setType(string $type)
 * @method                     $this setId(string $id)
 * @method                     $this setTitle(string $title)
 * @method                     $this setCaption(string $caption)
 * @method                     $this setParseMode(string $parseMode)
 * @method                     $this setCaptionEntities(MessageEntity[] $captionEntities)
 * @method                     $this setDocumentUrl(string $documentUrl)
 * @method                     $this setMimeType(string $mimeType)
 * @method                     $this setDescription(string $description)
 * @method                     $this setReplyMarkup(InlineKeyboardMarkup $replyMarkup)
 * @method                     $this setInputMessageContent(InputMessageContent $inputMessageContent)
 * @method                     $this setThumbUrl(string $thumbUrl)
 * @method                     $this setThumbWidth(int $thumbWidth)
 * @method                     $this setThumbHeight(int $thumbHeight)
 */
class InlineQueryResultDocument extends InlineQueryResult
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
	 * @param string $title
	 * @param string $documentUrl
	 * @param string $mimeType
	 * @param string|null $caption
	 * @param string|null $parseMode
     * @param MessageEntity[]|null $captionEntities
	 * @param string|null $description
	 * @param InlineKeyboardMarkup|null $replyMarkup
	 * @param InputMessageContent|null $inputMessageContent
	 * @param string|null $thumbUrl
	 * @param int|null $thumbWidth
	 * @param int|null $thumbHeight
	 *
	 * @return $this
	 */
	public static function make(
		$id,
		$title,
		$documentUrl,
		$mimeType,
		$caption = null,
		$parseMode = null,
        $captionEntities = null,
		$description = null,
		$replyMarkup = null,
		$inputMessageContent = null,
		$thumbUrl = null,
		$thumbWidth = null,
		$thumbHeight = null
	) {
		return new static([
			'type' => self::TYPE_DOCUMENT,
			'id' => $id,
			'title' => $title,
			'document_url' => $documentUrl,
			'mime_type' => $mimeType,
			'caption' => $caption,
			'parse_mode' => $parseMode,
            'caption_entities' => $captionEntities,
			'description' => $description,
			'reply_markup' => $replyMarkup,
			'input_message_content' => $inputMessageContent,
			'thumb_url' => $thumbUrl,
			'thumb_width' => $thumbWidth,
			'thumb_height' => $thumbHeight
		]);
	}
}
