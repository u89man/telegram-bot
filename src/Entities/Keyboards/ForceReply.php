<?php

namespace U89Man\TBot\Entities\Keyboards;

/**
 * @link https://core.telegram.org/bots/api#forcereply
 *
 * @method      bool getForceReply()
 * @method bool|null getSelective()
 * @method     $this setForceReply(bool $forceReply)
 * @method     $this setSelective(bool $selective)
 */
class ForceReply extends Keyboard
{
	/**
	 * @param bool|null $selective
     *
	 * @return ForceReply
	 */
	public static function make(
	    $selective = null
    ) {
	    return new static([
			'force_reply' => true,
			'selective' => $selective
		]);
	}
}
