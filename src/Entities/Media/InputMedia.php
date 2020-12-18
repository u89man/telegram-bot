<?php

namespace U89Man\TBot\Entities\Media;

use U89Man\TBot\Entities\Entity;

/**
 * @link https://core.telegram.org/bots/api#inputmedia
 */
abstract class InputMedia extends Entity
{
	const TYPE_PHOTO = 'photo';
	const TYPE_VIDEO = 'video';
	const TYPE_ANIMATION = 'animation';
	const TYPE_AUDIO = 'audio';
	const TYPE_DOCUMENT = 'document';
}
