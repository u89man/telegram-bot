<?php

namespace U89Man\TBot\Entities\Keyboards;

/**
 * @link https://core.telegram.org/bots/api#loginurl
 *
 * @method      string getUrl()
 * @method string|null getForwardText()
 * @method string|null getBotUsername()
 * @method   bool|null getRequestWriteAccess()
 *
 * @method       $this setUrl(string $url)
 * @method       $this setForwardText(string $forwardText)
 * @method       $this setBotUsername(string $botUsername)
 * @method       $this setRequestWriteAccess(bool $requestWriteAccess)
 */
class LoginUrl extends KeyboardEntity
{
	/**
	 * @param string $url
	 * @param string|null $forwardText
	 * @param string|null $botUsername
	 * @param bool|null $requestWriteAccess
     *
	 * @return $this
	 */
	public static function make(
		$url,
		$forwardText = null,
		$botUsername = null,
		$requestWriteAccess = null
	) {
	    return new static([
	    	'url' => $url,
	    	'forward_text' => $forwardText,
	    	'bot_username' => $botUsername,
	    	'request_write_access' => $requestWriteAccess
		]);
	}
}
