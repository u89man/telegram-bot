<?php

namespace U89Man\TBot\Entities\Payments;

use U89Man\TBot\Entities\Entity;
use U89Man\TBot\Entities\User;

/**
 * @link https://core.telegram.org/bots/api#shippingquery
 *
 * @method          string getId()
 * @method            User getFrom()
 * @method          string getInvoicePayload()
 * @method ShippingAddress getShippingAddress()
 */
class ShippingQuery extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'from' => User::class,
            'shipping_address' => ShippingAddress::class
        ];
    }
}
