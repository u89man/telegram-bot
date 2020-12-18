<?php

namespace U89Man\TBot\Entities\Payments;

use U89Man\TBot\Entities\Entity;

/**
 * @link https://core.telegram.org/bots/api#successfulpayment
 *
 * @method         string getCurrency()
 * @method            int getTotalAmount()
 * @method         string getInvoicePayload()
 * @method    string|null getShippingOptionId()
 * @method OrderInfo|null getOrderInfo()
 * @method         string getTelegramPaymentChargeId()
 * @method         string getProviderPaymentChargeId()
 */
class SuccessfulPayment extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'order_info' => OrderInfo::class
        ];
    }
}
