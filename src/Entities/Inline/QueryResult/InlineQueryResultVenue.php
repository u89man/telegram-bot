<?php

namespace U89Man\TBot\Entities\Inline\QueryResult;

use U89Man\TBot\Entities\Inline\Content\InputMessageContent;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup;

/**
 * @link https://core.telegram.org/bots/api#inlinequeryresultvenue
 *
 * @method                    string getType()
 * @method                    string getId()
 * @method                     float getLatitude()
 * @method                     float getLongitude()
 * @method                    string getTitle()
 * @method                    string getAddress()
 * @method               string|null getFoursquareId()
 * @method               string|null getFoursquareType()
 * @method               string|null getGooglePlaceId()
 * @method               string|null getGooglePlaceType()
 * @method InlineKeyboardMarkup|null getReplyMarkup()
 * @method  InputMessageContent|null getInputMessageContent()
 * @method               string|null getThumbUrl()
 * @method                  int|null getThumbWidth()
 * @method                  int|null getThumbHeight()
 *
 * @method                     $this setType(string $type)
 * @method                     $this setId(string $id)
 * @method                     $this setLatitude(float $latitude)
 * @method                     $this setLongitude(float $longitude)
 * @method                     $this setTitle(string $title)
 * @method                     $this setAddress(string $address)
 * @method                     $this setFoursquareId(string $foursquareId)
 * @method                     $this setFoursquareType(string $foursquareType)
 * @method                     $this setGooglePlaceId(string $googlePlaceId)
 * @method                     $this setGooglePlaceType(string $googlePlaceType)
 * @method                     $this setReplyMarkup(InlineKeyboardMarkup $replyMarkup)
 * @method                     $this setInputMessageContent(InputMessageContent $inputMessageContent)
 * @method                     $this setThumbUrl(string $thumbUrl)
 * @method                     $this setThumbWidth(int $thumbWidth)
 * @method                     $this setThumbHeight(int $thumbHeight)
 */
class InlineQueryResultVenue extends InlineQueryResult
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
	 * @param float $latitude
	 * @param float $longitude
	 * @param string $title
	 * @param string $address
     * @param string|null $googlePlaceId
     * @param string|null $googlePlaceType
	 * @param string|null $foursquareId
	 * @param string|null $foursquareType
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
		$latitude,
		$longitude,
		$title,
		$address,
        $googlePlaceId = null,
        $googlePlaceType = null,
		$foursquareId = null,
		$foursquareType = null,
		$replyMarkup = null,
		$inputMessageContent = null,
		$thumbUrl = null,
		$thumbWidth = null,
		$thumbHeight = null
	) {
		return new static([
			'type' => InlineQueryResult::TYPE_VENUE,
			'id' => $id,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'title' => $title,
			'address' => $address,
			'foursquare_id' => $foursquareId,
			'foursquare_type' => $foursquareType,
			'google_place_id' => $googlePlaceId,
			'google_place_type' => $googlePlaceType,
			'reply_markup' => $replyMarkup,
			'input_message_content' => $inputMessageContent,
			'thumb_url' => $thumbUrl,
			'thumb_width' => $thumbWidth,
			'thumb_height' => $thumbHeight
		]);
	}
}
