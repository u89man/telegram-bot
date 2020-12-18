<?php

namespace U89Man\TBot\Entities\Inline\QueryResult;

use U89Man\TBot\Entities\Inline\Content\InputMessageContent;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup;
use U89Man\TBot\Entities\MessageEntity;

/**
 * @link https://core.telegram.org/bots/api#inlinequeryresultvoice
 *
 * @method                    string getType()
 * @method                    string getId()
 * @method                    string getVoiceUrl()
 * @method                    string getTitle()
 * @method               string|null getCaption()
 * @method               string|null getParseMode()
 * @method      MessageEntity[]|null getCaptionEntities()
 * @method                  int|null getVoiceDuration()
 * @method InlineKeyboardMarkup|null getReplyMarkup()
 * @method  InputMessageContent|null getInputMessageContent()
 *
 * @method                     $this setType(string $type)
 * @method                     $this setId(string $id)
 * @method                     $this setVoiceUrl(string $voiceUrl)
 * @method                     $this setTitle(string $title)
 * @method                     $this setCaption(string $caption)
 * @method                     $this setParseMode(string $parseMode)
 * @method                     $this setCaptionEntities(MessageEntity[] $captionEntities)
 * @method                     $this setVoiceDuration(int $voiceDuration)
 * @method                     $this setReplyMarkup(InlineKeyboardMarkup $replyMarkup)
 * @method                     $this setInputMessageContent(InputMessageContent $inputMessageContent)
 */
class InlineQueryResultVoice extends InlineQueryResult
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
	 * @param string $voiceUrl
	 * @param string $title
	 * @param string|null $caption
	 * @param string|null $parseMode
     * @param MessageEntity[]|null $captionEntities
	 * @param int|null $voiceDuration
	 * @param InlineKeyboardMarkup|null $replyMarkup
	 * @param InputMessageContent|null $inputMessageContent
	 *
	 * @return $this
	 */
	public static function make(
		$id,
		$voiceUrl,
		$title,
		$caption = null,
		$parseMode = null,
        $captionEntities = null,
		$voiceDuration = null,
		$replyMarkup = null,
		$inputMessageContent = null
	) {
		return new static([
			'type' => self::TYPE_VOICE,
			'id' => $id,
			'voice_url' => $voiceUrl,
			'title' => $title,
			'caption' => $caption,
			'parse_mode' => $parseMode,
            'caption_entities' => $captionEntities,
			'voice_duration' => $voiceDuration,
			'reply_markup' => $replyMarkup,
			'input_message_content' => $inputMessageContent
		]);
	}
}
