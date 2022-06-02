<?php

namespace U89Man\TBot\Entities\Keyboards;

/**
 * @link https://core.telegram.org/bots/api#inlinekeyboardmarkup
 *
 * @method $this setInlineKeyboard(array $inlineKeyboard)
 */
class InlineKeyboardMarkup extends KeyboardEntity
{
    /**
     * @return InlineKeyboardButton[][]
     */
    public function getInlineKeyboard()
    {
        return $this->getArrayOfArray('inline_keyboard', InlineKeyboardButton::class);
    }

    /**
	 * @param InlineKeyboardButton[][] $inlineKeyboardButtons
     *
	 * @return $this
	 */
	public static function make(
	    $inlineKeyboardButtons
    ) {
		return new static([
			'inline_keyboard' => $inlineKeyboardButtons
		]);
	}
}
