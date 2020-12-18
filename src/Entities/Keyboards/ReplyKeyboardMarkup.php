<?php

namespace U89Man\TBot\Entities\Keyboards;

/**
 * @link https://core.telegram.org/bots/api#replykeyboardmarkup
 *
 * @method bool|null getResizeKeyboard()
 * @method bool|null getOneTimeKeyboard()
 * @method bool|null getSelective()
 *
 * @method     $this setKeyboard(array $keyboard)
 * @method     $this setResizeKeyboard(bool $resizeKeyboard)
 * @method     $this setOneTimeKeyboard(bool $oneTimeKeyboard)
 * @method     $this setSelective(bool $selective)
 */
class ReplyKeyboardMarkup extends Keyboard
{
    /**
     * @return KeyboardButton[][]|string[][]
     */
    public function getKeyboard()
    {
        return $this->getArrayOfArray('keyboard', KeyboardButton::class);
    }

	/**
	 * @param KeyboardButton[][]|string[][] $keyboard
	 * @param bool|null $resizeKeyboard
	 * @param bool|null $oneTimeKeyboard
	 * @param bool|null $selective
     *
	 * @return ReplyKeyboardMarkup
	 */
	public static function make(
		$keyboard,
		$resizeKeyboard = null,
		$oneTimeKeyboard = null,
		$selective = null
	){
	    return new static([
			'keyboard' => $keyboard,
			'resize_keyboard' => $resizeKeyboard,
			'one_time_keyboard' => $oneTimeKeyboard,
			'selective' => $selective,
		]);
	}
}
