<?php

namespace U89Man\TBot\Entities\Passport\Elements\Scopes;

/**
 * @link https://core.telegram.org/passport#passportscopeelementoneofseveral
 *
 * @method PassportScopeElementOne[] getOneOf()
 * @method                      bool getSelfie()
 * @method                      bool getTranslation()
 */
class PassportScopeElementOneOfSeveral extends PassportScopeElement
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'one_of' => [PassportScopeElementOne::class]
        ];
    }
}
