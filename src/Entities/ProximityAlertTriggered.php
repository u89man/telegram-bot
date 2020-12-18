<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#proximityalerttriggered
 *
 * @method User getTraveler()
 * @method User getWatcher()
 * @method  int getDistance()
 */
class ProximityAlertTriggered extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'traveler' => User::class,
            'watcher' => User::class
        ];
    }
}
