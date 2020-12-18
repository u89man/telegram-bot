<?php

namespace U89Man\TBot\Entities\Passport\Elements\Errors;

/**
 * @link https://core.telegram.org/bots/api#passportelementerrorunspecified
 *
 * @method string getSource()
 * @method string getType()
 * @method string getElementHash()
 * @method string getMessage()
 *
 * @method  $this setSource(string $source)
 * @method  $this setType(string $type)
 * @method  $this setElementHash(string $elementHash)
 * @method  $this setMessage(string $message)
 */
class PassportElementErrorUnspecified extends PassportElementError
{
	/**
	 * @param string $type
	 * @param string $elementHash
	 * @param string $message
	 *
	 * @return $this
	 */
	public static function make(
		$type,
        $elementHash,
		$message
	) {
		return new static([
			'source' => self::SOURCE_UNSPECIFIED,
			'type' => $type,
			'element_hash' => $elementHash,
			'message' => $message
		]);
	}
}
