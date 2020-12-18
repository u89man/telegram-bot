<?php

namespace U89Man\TBot\Entities\Inline\QueryResult;

use U89Man\TBot\Entities\Inline\Content\InputMessageContent;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup;

/**
 * @link https://core.telegram.org/bots/api#inlinequeryresultgame
 *
 * @method                    string getType()
 * @method                    string getId()
 * @method                    string getGameShortName()
 * @method InlineKeyboardMarkup|null getReplyMarkup()
 *
 * @method                     $this setType(string $type)
 * @method                     $this setId(string $id)
 * @method                     $this setGameShortName(string $gameShortName)
 * @method                     $this setReplyMarkup(InlineKeyboardMarkup $replyMarkup)
 */
class InlineQueryResultGame extends InlineQueryResult
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'reply_markup' => InlineKeyboardMarkup::class,
            'input_message_content' => InputMessageContent::class
        ];
    }

	/**
	 * @param string $id
	 * @param string $gameShortName
	 * @param InlineKeyboardMarkup|null $replyMarkup
	 *
	 * @return $this
	 */
	public static function make(
		$id,
		$gameShortName,
		$replyMarkup = null
	) {
	    return new static([
			'type' => self::TYPE_GAME,
			'id' => $id,
			'game_short_name' => $gameShortName,
			'reply_markup' => $replyMarkup
		]);
	}
}
