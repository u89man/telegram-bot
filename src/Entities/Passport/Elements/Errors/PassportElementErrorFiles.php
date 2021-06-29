<?php

namespace U89Man\TBot\Entities\Passport\Elements\Errors;

/**
 * @link https://core.telegram.org/bots/api#passportelementerrorfiles
 *
 * @method   string getSource()
 * @method   string getType()
 * @method string[] getFileHashes()
 * @method   string getMessage()
 *
 * @method    $this setSource(string $source)
 * @method    $this setType(string $type)
 * @method    $this setFileHashes(string[] $fileHashes)
 * @method    $this setMessage(string $message)
 */
class PassportElementErrorFiles extends PassportElementError
{
	/**
	 * @param string $type
	 * @param string[] $fileHashes
	 * @param string $message
	 *
	 * @return $this
	 */
	public static function make(
		$type,
        $fileHashes,
		$message
	) {
		return new static([
			'source' => PassportElementError::SOURCE_FILES,
			'type' => $type,
			'file_hashes' => $fileHashes,
			'message' => $message
		]);
	}
}
