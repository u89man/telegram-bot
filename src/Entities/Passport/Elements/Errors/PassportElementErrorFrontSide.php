<?php

namespace U89Man\TBot\Entities\Passport\Elements\Errors;

/**
 * @link https://core.telegram.org/bots/api#passportelementerrorfrontside
 *
 * @method string getSource()
 * @method string getType()
 * @method string getFileHash()
 * @method string getMessage()
 *
 * @method  $this setSource(string $source)
 * @method  $this setType(string $type)
 * @method  $this setFileHash(string $fileHash)
 * @method  $this setMessage(string $message)
 */
class PassportElementErrorFrontSide extends PassportElementError
{
	/**
	 * @param string $type
	 * @param string $fileHash
	 * @param string $message
	 *
	 * @return $this
	 */
	public static function make(
		$type,
        $fileHash,
		$message
	) {
		return new static([
			'source' => self::SOURCE_FRONT_SIDE,
			'type' => $type,
			'file_hash' => $fileHash,
			'message' => $message
		]);
	}
}
