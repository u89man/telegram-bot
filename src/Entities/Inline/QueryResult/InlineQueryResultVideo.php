<?php

namespace U89Man\TBot\Entities\Inline\QueryResult;

use U89Man\TBot\Entities\Inline\Content\InputMessageContent;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup;
use U89Man\TBot\Entities\MessageEntity;

/**
 * @link https://core.telegram.org/bots/api#inlinequeryresultvideo
 *
 * @method                    string getType()
 * @method                    string getId()
 * @method                    string getVideo4Url()
 * @method                    string getMimeType()
 * @method                    string getThumbUrl()
 * @method                    string getTitle()
 * @method               string|null getCaption()
 * @method               string|null getParseMode()
 * @method      MessageEntity[]|null getCaptionEntities()
 * @method                  int|null getVideoWidth()
 * @method                  int|null getVideoHeight()
 * @method                  int|null getVideoDuration()
 * @method               string|null getDescription()
 * @method InlineKeyboardMarkup|null getReplyMarkup()
 * @method  InputMessageContent|null getInputMessageContent()
 *
 * @method                     $this setType(string $type)
 * @method                     $this setId(string $id)
 * @method                     $this setVideoUrl(string $videoUrl)
 * @method                     $this setMimeType(string $mimeType)
 * @method                     $this setThumbUrl(string $thumbUrl)
 * @method                     $this setTitle(string $title)
 * @method                     $this setCaption(string $caption)
 * @method                     $this setParseMode(string $parseMode)
 * @method                     $this setCaptionEntities(MessageEntity[] $captionEntities)
 * @method                     $this setVideoWidth(int $video4Width)
 * @method                     $this setVideoHeight(int $videoHeight)
 * @method                     $this setVideoDuration(int $videoDuration)
 * @method                     $this setDescription(string $description)
 * @method                     $this setReplyMarkup(InlineKeyboardMarkup $replyMarkup)
 * @method                     $this setInputMessageContent(InputMessageContent $inputMessageContent)
 */
class InlineQueryResultVideo extends InlineQueryResult
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
	 * @param string $videoUrl
	 * @param string $mimeType
	 * @param string $thumbUrl
	 * @param string $title
	 * @param string|null $caption
	 * @param string|null $parseMode
     * @param MessageEntity[]|null $captionEntities
	 * @param int|null $videoWidth
	 * @param int|null $videoHeight
	 * @param int|null $videoDuration
	 * @param string|null $description
	 * @param InlineKeyboardMarkup|null $replyMarkup
	 * @param InputMessageContent|null $inputMessageContent
	 *
	 * @return $this
	 */
	public static function make(
		$id,
		$videoUrl,
		$mimeType,
		$thumbUrl,
		$title,
		$caption = null,
		$parseMode = null,
        $captionEntities = null,
		$videoWidth = null,
		$videoHeight = null,
		$videoDuration = null,
		$description = null,
		$replyMarkup = null,
		$inputMessageContent = null
	) {
		return new static([
			'type' => self::TYPE_VIDEO,
			'id' => $id,
			'video_url' => $videoUrl,
			'mime_type' => $mimeType,
			'thumb_url' => $thumbUrl,
			'title' => $title,
			'caption' => $caption,
			'parse_mode' => $parseMode,
            'caption_entities' => $captionEntities,
			'video_width' => $videoWidth,
			'video_height' => $videoHeight,
			'video_duration' => $videoDuration,
			'description' => $description,
			'reply_markup' => $replyMarkup,
			'input_message_content' => $inputMessageContent
		]);
	}
}
