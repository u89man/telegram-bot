<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#venue
 *
 * @method    Location getLocation()
 * @method      string getTitle()
 * @method      string getAddress()
 * @method string|null getFoursquareId()
 * @method string|null getFoursquareType()
 * @method string|null getGooglePlaceId()
 * @method string|null getGooglePlaceType()
 */
class Venue extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'location' => Location::class
        ];
    }
}
