<?php

namespace U89Man\TBot\Entities\Inline\QueryResult;

use U89Man\TBot\Entities\Inline\Content\InputMessageContent;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup;

/**
 * @link https://core.telegram.org/bots/api#inlinequeryresultcontact
 *
 * @method                    string getType()
 * @method                    string getId()
 * @method                    string getPhoneNumber()
 * @method                    string getFirstName()
 * @method               string|null getLastName()
 * @method               string|null getVcard()
 * @method InlineKeyboardMarkup|null getReplyMarkup()
 * @method  InputMessageContent|null getInputMessageContent()
 * @method               string|null getThumbUrl()
 * @method                  int|null getThumbWidth()
 * @method                  int|null getThumbHeight()
 *
 * @method                     $this setType(string $type)
 * @method                     $this setId(string $id)
 * @method                     $this setPhoneNumber(string $phoneNumber)
 * @method                     $this setFirstName(string $firstName)
 * @method                     $this setLastName(string $lastName)
 * @method                     $this setVcard(string $vcard)
 * @method                     $this setReplyMarkup(InlineKeyboardMarkup $replyMarkup)
 * @method                     $this setInputMessageContent(InputMessageContent $inputMessageContent)
 * @method                     $this setThumbUrl(string $thumbUrl)
 * @method                     $this setThumbWidth(int $thumbWidth)
 * @method                     $this setThumbHeight(int $thumbHeight)
 */
class InlineQueryResultContact extends InlineQueryResult
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'reply_markup' => InlineKeyboardMarkup::class,
            'input_message_content' => InputMessageContent::class
        ];
    }

	/**
	 * @param string $id
	 * @param string $phoneNumber
	 * @param string $firstName
	 * @param string|null $lastName
	 * @param string|null $vcard
	 * @param InlineKeyboardMarkup|null $replyMarkup
	 * @param InputMessageContent|null $inputMessageContent
	 * @param string|null $thumbUrl
	 * @param int|null $thumbWidth
	 * @param int|null $thumbHeight
	 *
	 * @return $this
	 */
	public static function make(
		$id,
		$phoneNumber,
		$firstName,
		$lastName = null,
		$vcard = null,
		$replyMarkup = null,
		$inputMessageContent = null,
		$thumbUrl = null,
		$thumbWidth = null,
		$thumbHeight = null
	) {
		return new static([
			'type' => self::TYPE_CONTACT,
			'id' => $id,
			'phone_number' => $phoneNumber,
			'first_name' => $firstName,
			'last_name' => $lastName,
			'vcard' => $vcard,
			'reply_markup' => $replyMarkup,
			'input_message_content' => $inputMessageContent,
			'thumb_url' => $thumbUrl,
			'thumb_width' => $thumbWidth,
			'thumb_height' => $thumbHeight
		]);
	}
}
