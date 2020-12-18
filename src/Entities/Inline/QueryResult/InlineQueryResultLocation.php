<?php

namespace U89Man\TBot\Entities\Inline\QueryResult;

use U89Man\TBot\Entities\Inline\Content\InputMessageContent;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup;

/**
 * @link https://core.telegram.org/bots/api#inlinequeryresultlocation
 *
 * @method                    string getType()
 * @method                    string getId()
 * @method                     float getLatitude()
 * @method                     float getLongitude()
 * @method                    string getTitle()
 * @method                float|null getHorizontalAccuracy()
 * @method                  int|null getLivePeriod()
 * @method                  int|null getHeading()
 * @method                  int|null getProximityAlertRadius()
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
 * @method                     $this setHorizontalAccuracy(float $horizontalAccuracy)
 * @method                     $this setLivePeriod(int $livePeriod)
 * @method                     $this setHeading(int $heading)
 * @method                     $this setProximityAlertRadius(int $proximityAlertRadius)
 * @method                     $this setReplyMarkup(InlineKeyboardMarkup $replyMarkup)
 * @method                     $this setInputMessageContent(InputMessageContent $inputMessageContent)
 * @method                     $this setThumbUrl(string $thumbUrl)
 * @method                     $this setThumbWidth(int $thumbWidth)
 * @method                     $this setThumbHeight(int $thumbHeight)
 */
class InlineQueryResultLocation extends InlineQueryResult
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
	 * @param float|null $horizontalAccuracy
	 * @param int|null $livePeriod
	 * @param int|null $heading
	 * @param int|null $proximityAlertRadius
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
        $horizontalAccuracy = null,
		$livePeriod = null,
        $heading = null,
        $proximityAlertRadius = null,
		$replyMarkup = null,
		$inputMessageContent = null,
		$thumbUrl = null,
		$thumbWidth = null,
		$thumbHeight = null
	) {
		return new static([
			'type' => self::TYPE_LOCATION,
			'id' => $id,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'title' => $title,
			'horizontal_accuracy' => $horizontalAccuracy != null && $horizontalAccuracy >= 0 && $horizontalAccuracy <= 1500 ? $horizontalAccuracy : null,
			'live_period' => $livePeriod,
			'heading' => $heading,
			'proximity_alert_radius' => $proximityAlertRadius,
			'reply_markup' => $replyMarkup,
			'input_message_content' => $inputMessageContent,
			'thumb_url' => $thumbUrl,
			'thumb_width' => $thumbWidth,
			'thumb_height' => $thumbHeight
		]);
	}
}
