<?php

namespace U89Man\TBot\Entities\Inline\Content;

/**
 * @link https://core.telegram.org/bots/api#inputvenuemessagecontent
 *
 * @method       float getLatitude()
 * @method       float getLongitude()
 * @method      string getTitle()
 * @method      string getAddress()
 * @method string|null getFoursquareId()
 * @method string|null getFoursquareType()
 * @method string|null getGooglePlaceId()
 * @method string|null getGooglePlaceType()
 *
 * @method       $this setLatitude(float $latitude)
 * @method       $this setLongitude(float $longitude)
 * @method       $this setTitle(string $title)
 * @method       $this setAddress(string $address)
 * @method       $this setFoursquareId(string $foursquareId)
 * @method       $this setFoursquareType(string $foursquareType)
 * @method       $this setGooglePlaceId(string $googlePlaceId)
 * @method       $this setGooglePlaceType(string $googlePlaceType)
 */
class InputVenueMessageContent extends InputMessageContent
{
	/**
	 * @param float $latitude
	 * @param float $longitude
	 * @param string $title
	 * @param string $address
     * @param string|null $googlePlaceId
     * @param string|null $googlePlaceType
	 * @param string|null $foursquareId
	 * @param string|null $foursquareType
     *
	 * @return $this
	 */
	public static function make(
		$latitude,
		$longitude,
		$title,
		$address,
        $googlePlaceId = null,
        $googlePlaceType = null,
		$foursquareId = null,
		$foursquareType = null
	) {
		return new static([
			'latitude' => $latitude,
			'longitude' => $longitude,
			'title' => $title,
			'address' => $address,
			'foursquare_id' => $foursquareId,
			'foursquare_type' => $foursquareType,
            'google_place_id' => $googlePlaceId,
            'google_place_type' => $googlePlaceType
        ]);
	}
}
