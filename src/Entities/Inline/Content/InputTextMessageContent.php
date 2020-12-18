<?php

namespace U89Man\TBot\Entities\Inline\Content;

use U89Man\TBot\Entities\MessageEntity;

/**
 * @link https://core.telegram.org/bots/api#inputtextmessagecontent
 *
 * @method               string getMessageText()
 * @method          string|null getParseMode()
 * @method MessageEntity[]|null getEntities()
 * @method            bool|null getDisableWebPagePreview()
 *
 * @method                $this setMessageText(string $messageText)
 * @method                $this setParseMode(string $parseMode)
 * @method                $this setEntities(MessageEntity[] $entities)
 * @method                $this setDisableWebPagePreview(bool $disableWebPagePreview)
 */
class InputTextMessageContent extends InputMessageContent
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'entities' => [MessageEntity::class]
        ];
    }

	/**
	 * @param string $messageText
	 * @param string|null $parseMode
	 * @param MessageEntity[]|null $entities
	 * @param bool|null $disableWebPagePreview
	 *
	 * @return $this
	 */
	public static function make(
		$messageText,
		$parseMode = null,
        $entities = null,
		$disableWebPagePreview = null
	) {
	    return new static([
			'message_text' => $messageText,
			'parse_mode' => $parseMode,
			'entities' => $entities,
			'disable_web_page_preview' => $disableWebPagePreview
		]);
	}
}
