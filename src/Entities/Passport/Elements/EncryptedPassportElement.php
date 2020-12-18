<?php

namespace U89Man\TBot\Entities\Passport\Elements;

use U89Man\TBot\Entities\Passport\PassportFile;

/**
 * @link https://core.telegram.org/bots/api#encryptedpassportelement
 *
 * @return              string getType()
 * @return         string|null getData()
 * @return         string|null getPhoneNumber()
 * @return         string|null getEmail()
 * @return PassportFile[]|null getFiles()
 * @return   PassportFile|null getFrontSide()
 * @return   PassportFile|null getReverseSide()
 * @return   PassportFile|null getSelfie()
 * @return PassportFile[]|null getTranslation()
 * @return              string getHash()
 */
class EncryptedPassportElement extends PassportElement
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'files' => [PassportFile::class],
            'front_side' => PassportFile::class,
            'reverse_side' => PassportFile::class,
            'selfie' => PassportFile::class,
            'translation' => [PassportFile::class]
        ];
    }
}
