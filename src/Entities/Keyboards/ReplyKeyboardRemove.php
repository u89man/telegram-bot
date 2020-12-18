<?php

namespace U89Man\TBot\Entities\Keyboards;

/**
 * @link https://core.telegram.org/bots/api#replykeyboardremove
 *
 * @method      bool getRemoveKeyboard()
 * @method bool|null getSelective()
 *
 * @method     $this setRemoveKeyboard(bool $removeKeyboard)
 * @method     $this setSelective(bool $selective)
 */
class ReplyKeyboardRemove extends Keyboard
{
	/**
	 * @param bool|null $selective
     *
	 * @return $this
	 */
	public static function make(
	    $selective = null
    ) {
	    return new static([
	    	'remove_keyboard' => true,
			'selective' => $selective
		]);
	}
}
