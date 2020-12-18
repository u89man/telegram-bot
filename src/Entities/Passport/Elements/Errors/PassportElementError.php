<?php

namespace U89Man\TBot\Entities\Passport\Elements\Errors;

use U89Man\TBot\Entities\Passport\Elements\PassportElement;

/**
 * @link https://core.telegram.org/bots/api#passportelementerror
 */
abstract class PassportElementError extends PassportElement
{
	const SOURCE_DATA = 'data';
	const SOURCE_FRONT_SIDE = 'front_side';
	const SOURCE_REVERSE_SIDE = 'reverse_side';
	const SOURCE_SELFIE = 'selfie';
	const SOURCE_FILE = 'file';
	const SOURCE_FILES = 'files';
	const SOURCE_TRANSLATION_FILE = 'translation_file';
	const SOURCE_TRANSLATION_FILES = 'translation_files';
	const SOURCE_UNSPECIFIED = 'unspecified';
}
