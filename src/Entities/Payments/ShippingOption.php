<?php

namespace U89Man\TBot\Entities\Payments;

use U89Man\TBot\Entities\Entity;

/**
 * @link https://core.telegram.org/bots/api#shippingoption
 *
 * @method         string getId()
 * @method         string getTitle()
 * @method LabeledPrice[] getPrices()
 */
class ShippingOption extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'prices' => [LabeledPrice::class]
        ];
    }
}
