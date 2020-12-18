<?php

namespace U89Man\TBot\Entities\Passport;

use U89Man\TBot\Entities\Entity;
use U89Man\TBot\Entities\Passport\Elements\Scopes\PassportScopeElement;

/**
 * @link https://core.telegram.org/passport#passportscope
 *
 * @method PassportScopeElement[] getData()
 * @method                    int getV()
 */
class PassportScope extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'data' => [PassportScopeElement::class]
        ];
    }
}
