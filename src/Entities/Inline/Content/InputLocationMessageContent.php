<?php

namespace U89Man\TBot\Entities\Inline\Content;

/**
 * @link https://core.telegram.org/bots/api#inputlocationmessagecontent
 *
 * @method      float getLatitude()
 * @method      float getLongitude()
 * @method float|null getHorizontalAccuracy()
 * @method   int|null getLivePeriod()
 * @method   int|null getHeading()
 * @method   int|null getProximityAlertRadius()
 *
 * @method      $this setLatitude(float $latitude)
 * @method      $this setLongitude(float $longitude)
 * @method      $this setHorizontalAccuracy(float $horizontalAccuracy)
 * @method      $this setLivePeriod(int $livePeriod)
 * @method      $this setHeading(int $heading)
 * @method      $this setProximityAlertRadius(int $proximityAlertRadius)
 */
class InputLocationMessageContent extends InputMessageContent
{
	/**
	 * @param float $latitude
	 * @param float $longitude
	 * @param float|null $horizontalAccuracy
	 * @param int|null $livePeriod
	 * @param int|null $heading
	 * @param int|null $proximityAlertRadius
	 *
	 * @return $this
	 */
	public static function make(
		$latitude,
		$longitude,
        $horizontalAccuracy = null,
		$livePeriod = null,
        $heading = null,
        $proximityAlertRadius = null
	) {
		return new static([
			'latitude' => $latitude,
			'longitude' => $longitude,
			'horizontal_accuracy' => $horizontalAccuracy,
			'live_period' => $livePeriod,
			'heading' => $heading,
			'proximity_alert_radius' => $proximityAlertRadius
		]);
	}
}
