<?php

namespace U89Man\TBot\Entities\Inline\Content;

use U89Man\TBot\Entities\Payments\LabeledPrice;

/**
 * @link https://core.telegram.org/bots/api#inputinvoicemessagecontent
 *
 * @method         string getTitle()
 * @method         string getDescription()
 * @method         string getPayload()
 * @method         string getProviderToken()
 * @method         string getCurrency()
 * @method LabeledPrice[] getPrices()
 * @method            int getMaxTipAmount()
 * @method          int[] getSuggestedTipAmounts()
 * @method         string getProviderData()
 * @method         string getPhotoUrl()
 * @method            int getPhotoSize()
 * @method            int getPhotoWidth()
 * @method            int getPhotoHeight()
 * @method           bool getNeedName()
 * @method           bool getNeedPhoneNumber()
 * @method           bool getNeedEmail()
 * @method           bool getNeedShippingAddress()
 * @method           bool getSendPhoneNumberToProvider()
 * @method           bool getSendEmailToProvider()
 * @method           bool getIsFlexible()
 *
 * @method          $this setTitle(string $title)
 * @method          $this setDescription(string $description)
 * @method          $this setPayload(string $payload)
 * @method          $this setProviderToken(string $providerToken)
 * @method          $this setCurrency(string $currency)
 * @method          $this setPrices(LabeledPrice[] $prices)
 * @method          $this setMaxTipAmount(int $maxTipAmount)
 * @method          $this setSuggestedTipAmounts(int[] $suggestedTipAmounts)
 * @method          $this setProviderData(string $providerData)
 * @method          $this setPhotoUrl(string $photoUrl)
 * @method          $this setPhotoSize(int $photoSize)
 * @method          $this setPhotoWidth(int $photoWidth)
 * @method          $this setPhotoHeight(int $photoHeight)
 * @method          $this setNeedName(bool $needName)
 * @method          $this setNeedPhoneNumber(bool $needPhoneNumber)
 * @method          $this setNeedEmail(bool $needEmail)
 * @method          $this setNeedShippingAddress(bool $needShippingAddress)
 * @method          $this setSendPhoneNumberToProvider(bool $sendPhoneNumberToProvider)
 * @method          $this setSendEmailToProvider(bool $sendEmailToProvider)
 * @method          $this setIsFlexible(bool $isFlexible)
 */
class InputInvoiceMessageContent extends InputMessageContent
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'prices' => LabeledPrice::class
        ];
    }

    /**
     * @param string $title
     * @param string $description
     * @param string $payload
     * @param string $providerToken
     * @param string $currency
     * @param LabeledPrice[] $prices
     * @param int|null $maxTipAmount
     * @param int[]|null $suggestedTipAmounts
     * @param string|null $providerData
     * @param string|null $photoUrl
     * @param int|null $photoSize
     * @param int|null $photoWidth
     * @param int|null $photoHeight
     * @param bool|null $needName
     * @param bool|null $needPhoneNumber
     * @param bool|null $needEmail
     * @param bool|null $needShippingAddress
     * @param bool|null $sendPhoneNumberToProvider
     * @param bool|null $sendEmailToProvider
     * @param bool|null $isFlexible
     *
     * @return $this
     */
    public static function make(
        $title,
        $description,
        $payload,
        $providerToken,
        $currency,
        $prices,
        $maxTipAmount = null,
        $suggestedTipAmounts = null,
        $providerData = null,
        $photoUrl = null,
        $photoSize = null,
        $photoWidth = null,
        $photoHeight = null,
        $needName = null,
        $needPhoneNumber = null,
        $needEmail = null,
        $needShippingAddress = null,
        $sendPhoneNumberToProvider = null,
        $sendEmailToProvider = null,
        $isFlexible = null
    ) {
        return new static([
            'title' => $title,
            'description' => $description,
            'payload' => $payload,
            'provider_token' => $providerToken,
            'currency' => $currency,
            'prices' => $prices,
            'max_tip_amount' => $maxTipAmount,
            'suggested_tip_amounts' => $suggestedTipAmounts,
            'provider_data' => $providerData,
            'photo_url' => $photoUrl,
            'photo_size' => $photoSize,
            'photo_width' => $photoWidth,
            'photo_height' => $photoHeight,
            'need_name' => $needName,
            'need_phone_number' => $needPhoneNumber,
            'need_email' => $needEmail,
            'need_shipping_address' => $needShippingAddress,
            'send_phone_number_to_provider' => $sendPhoneNumberToProvider,
            'send_email_to_provider' => $sendEmailToProvider,
            'is_flexible' => $isFlexible
        ]);
    }
}
