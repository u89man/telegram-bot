<?php

namespace U89Man\TBot\Entities\Passport;

use U89Man\TBot\Entities\Entity;
use U89Man\TBot\Entities\Passport\Elements\EncryptedPassportElement;

/**
 * @link https://core.telegram.org/bots/api#passportdata
 *
 * @method EncryptedPassportElement[] getData()
 * @method       EncryptedCredentials getCredentials()
 */
class PassportData extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'data' => [EncryptedPassportElement::class],
            'credentials' => EncryptedCredentials::class
        ];
    }
}
