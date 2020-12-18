<?php

namespace U89Man\TBot\Entities\Passport;

use U89Man\TBot\Entities\Entity;

/**
 * @link https://core.telegram.org/passport#securedata
 *
 * @method SecureValue|null getPersonalDetails()
 * @method SecureValue|null getPassport()
 * @method SecureValue|null getInternalPassport()
 * @method SecureValue|null getDriverLicense()
 * @method SecureValue|null getIdentityCard()
 * @method SecureValue|null getAddress()
 * @method SecureValue|null getUtilityBill()
 * @method SecureValue|null getBankStatement()
 * @method SecureValue|null getRentalAgreement()
 * @method SecureValue|null getPassportRegistration()
 * @method SecureValue|null getTemporaryRegistration()
 */
class SecureData extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'personal_details' => SecureValue::class,
            'passport' => SecureValue::class,
            'internal_passport' => SecureValue::class,
            'driver_license' => SecureValue::class,
            'identity_card' => SecureValue::class,
            'address' => SecureValue::class,
            'utility_bill' => SecureValue::class,
            'bank_statement' => SecureValue::class,
            'rental_agreement' => SecureValue::class,
            'passport_registration' => SecureValue::class,
            'temporary_registration' => SecureValue::class,
        ];
    }
}
