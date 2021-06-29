<?php

namespace U89Man\TBot\Entities\Passport\Elements\Errors;

/**
 * @link https://core.telegram.org/bots/api#passportelementerrordatafield
 *
 * @method string getSource()
 * @method string getType()
 * @method string getFieldName()
 * @method string getDataHash()
 * @method string getMessage()
 *
 * @method  $this setSource(string $source)
 * @method  $this setType(string $type)
 * @method  $this setFieldName(string $fieldName)
 * @method  $this setDataHash(string $dataHash)
 * @method  $this setMessage(string $message)
 */
class PassportElementErrorDataField extends PassportElementError
{
	/**
	 * @param string $type
	 * @param string $fieldName
	 * @param string $dataHash
	 * @param string $message
	 *
	 * @return $this
	 */
	public static function make(
		$type,
		$fieldName,
        $dataHash,
		$message
	) {
		return new static([
			'source' => PassportElementError::SOURCE_DATA,
			'type' => $type,
			'field_name' => $fieldName,
			'data_hash' => $dataHash,
			'message' => $message
		]);
	}
}
