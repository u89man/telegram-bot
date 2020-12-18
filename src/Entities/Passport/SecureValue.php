<?php

namespace U89Man\TBot\Entities\Passport;

use U89Man\TBot\Entities\Entity;

/**
 * @link https://core.telegram.org/passport#securevalue
 *
 * @method   DataCredentials|null getData()
 * @method   FileCredentials|null getFrontSide()
 * @method   FileCredentials|null getReverseSide()
 * @method   FileCredentials|null getSelfie()
 * @method FileCredentials[]|null getTranslation()
 * @method FileCredentials[]|null getFiles()
 */
class SecureValue extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'data' => DataCredentials::class,
            'front_side' => FileCredentials::class,
            'reverse_side' => FileCredentials::class,
            'selfie' => FileCredentials::class,
            'translation' => [FileCredentials::class],
            'files' => [FileCredentials::class]
        ];
    }
}
