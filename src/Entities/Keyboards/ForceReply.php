<?php

namespace U89Man\TBot\Entities\Keyboards;

/**
 * @link https://core.telegram.org/bots/api#forcereply
 *
 * @method        bool getForceReply()
 * @method string|null getInputFieldPlaceholder()
 * @method   bool|null getSelective()
 *
 * @method       $this setForceReply(bool $forceReply)
 * @method       $this setInputFieldPlaceholder(string $inputFieldPlaceholder)
 * @method       $this setSelective(bool $selective)
 */
class ForceReply extends Keyboard
{
	/**
	 * @param bool|null $selective
     * @param string|null $inputFieldPlaceholder
     *
	 * @return ForceReply
	 */
	public static function make(
        $inputFieldPlaceholder = null,
	    $selective = null
    ) {
	    return new static([
			'force_reply' => true,
            'input_field_placeholder' => $inputFieldPlaceholder,
			'selective' => $selective
		]);
	}
}
