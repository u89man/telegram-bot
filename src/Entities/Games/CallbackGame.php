<?php

namespace U89Man\TBot\Entities\Games;

use U89Man\TBot\Entities\Entity;

/**
 * @link https://core.telegram.org/bots/api#callbackgame
 */
class CallbackGame extends Entity
{
	/**
	 * @return $this
	 */
	public static function make()
    {
	    return new static([
	    	//
		]);
	}
}
