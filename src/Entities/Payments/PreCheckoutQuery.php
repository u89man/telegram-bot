<?php

namespace U89Man\TBot\Entities\Payments;

use U89Man\TBot\Entities\Entity;
use U89Man\TBot\Entities\User;

/**
 * @link https://core.telegram.org/bots/api#precheckoutquery
 *
 * @method         string getId()
 * @method           User getFrom()
 * @method         string getCurrency()
 * @method            int getTotalAmount()
 * @method         string getInvoicePayload()
 * @method    string|null getShippingOptionId()
 * @method OrderInfo|null getOrderInfo()
 */
class PreCheckoutQuery extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'from' => User::class,
            'order_info' => OrderInfo::class
        ];
    }
}
