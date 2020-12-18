<?php

namespace U89Man\TBot\Entities\Inline\Content;

/**
 * @link https://core.telegram.org/bots/api#inputcontactmessagecontent
 *
 * @method      string getPhoneNumber()
 * @method      string getFirstName()
 * @method string|null getLastName()
 * @method string|null getVcard()
 *
 * @method       $this setPhoneNumber(string $phoneNumber)
 * @method       $this setFirstName(string $firstName)
 * @method       $this setLastName(string $lastName)
 * @method       $this setVcard(string $vcard)
 */
class InputContactMessageContent extends InputMessageContent
{
	/**
	 * @param string $phoneNumber
	 * @param string $firstName
	 * @param string|null $lastName
	 * @param string|null $vcard
	 *
	 * @return $this
	 */
	public static function make(
		$phoneNumber,
		$firstName,
		$lastName = null,
		$vcard = null
	) {
		return new static([
			'phone_number' => $phoneNumber,
			'first_name' => $firstName,
			'last_name' => $lastName,
			'vcard' => $vcard
		]);
	}
}
