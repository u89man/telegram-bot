<?php

namespace U89Man\TBot\Entities\Keyboards;

/**
 * @link https://core.telegram.org/bots/api#keyboardbuttonpolltype
 *
 * @method string|null getType()
 *
 * @method       $this setType(string $type)
 */
class KeyboardButtonPollType extends Keyboard
{
	/**
	 * @param string|null $type
     *
	 * @return $this
	 */
	public static function make($type = null)
    {
	    return new static([
	    	'type' => $type
		]);
	}
}
