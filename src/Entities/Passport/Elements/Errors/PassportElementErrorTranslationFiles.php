<?php

namespace U89Man\TBot\Entities\Passport\Elements\Errors;

/**
 * @link https://core.telegram.org/bots/api#passportelementerrortranslationfiles
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
class PassportElementErrorTranslationFiles extends PassportElementError
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
			'source' => self::SOURCE_TRANSLATION_FILES,
			'type' => $type,
			'file_hashes' => $fileHashes,
			'message' => $message
		]);
	}
}
