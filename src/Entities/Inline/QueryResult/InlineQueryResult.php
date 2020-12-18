<?php

namespace U89Man\TBot\Entities\Inline\QueryResult;

use U89Man\TBot\Entities\Entity;

/**
 * @link https://core.telegram.org/bots/api#inlinequeryresult
 */
abstract class InlineQueryResult extends Entity
{
	const MIME_TYPE_HTML = 'text/html';
	const MIME_TYPE_MP4 = 'video/mp4';
    const MIME_TYPE_JPEG = 'image/jpeg';
    const MIME_TYPE_GIF = 'image/gif';
	const MIME_TYPE_PDF = 'application/pdf';
	const MIME_TYPE_ZIP = 'application/zip';

	const TYPE_ARTICLE = 'article';
	const TYPE_AUDIO = 'audio';
	const TYPE_CONTACT = 'contact';
	const TYPE_DOCUMENT = 'document';
	const TYPE_GAME = 'game';
	const TYPE_GIF = 'gif';
	const TYPE_LOCATION = 'location';
	const TYPE_MPEG4_GIF = 'mpeg4_gif';
	const TYPE_PHOTO = 'photo';
	const TYPE_STICKER = 'sticker';
	const TYPE_VENUE = 'venue';
	const TYPE_VIDEO = 'video';
	const TYPE_VOICE = 'voice';
}
