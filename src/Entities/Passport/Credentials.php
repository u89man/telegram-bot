<?php

namespace U89Man\TBot\Entities\Passport;

use U89Man\TBot\Entities\Entity;

/**
 * @link https://core.telegram.org/passport#credentials
 *
 * @method SecureData getSecureData()
 * @method     string getNonce()
 */
class Credentials extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'secure_data' => SecureData::class
        ];
    }
}
