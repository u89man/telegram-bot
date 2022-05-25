<?php

namespace U89Man\TBot;

use U89Man\TBot\Entities\BotCommand;
use U89Man\TBot\Entities\BotCommands\BotCommandScope;
use U89Man\TBot\Entities\Chat;
use U89Man\TBot\Entities\ChatInviteLink;
use U89Man\TBot\Entities\ChatPermissions;
use U89Man\TBot\Entities\File;
use U89Man\TBot\Entities\Games\GameHighScore;
use U89Man\TBot\Entities\Inline\QueryResult\InlineQueryResult;
use U89Man\TBot\Entities\InputFile;
use U89Man\TBot\Entities\Keyboards\ForceReply;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup;
use U89Man\TBot\Entities\Keyboards\ReplyKeyboardMarkup;
use U89Man\TBot\Entities\Keyboards\ReplyKeyboardRemove;
use U89Man\TBot\Entities\Media\InputMedia;
use U89Man\TBot\Entities\Media\InputMediaAudio;
use U89Man\TBot\Entities\Media\InputMediaDocument;
use U89Man\TBot\Entities\Media\InputMediaPhoto;
use U89Man\TBot\Entities\Media\InputMediaVideo;
use U89Man\TBot\Entities\Members\ChatMember;
use U89Man\TBot\Entities\Message;
use U89Man\TBot\Entities\MessageEntity;
use U89Man\TBot\Entities\MessageId;
use U89Man\TBot\Entities\Passport\Elements\Errors\PassportElementError;
use U89Man\TBot\Entities\Payments\LabeledPrice;
use U89Man\TBot\Entities\Payments\ShippingOption;
use U89Man\TBot\Entities\Poll\Poll;
use U89Man\TBot\Entities\Stickers\MaskPosition;
use U89Man\TBot\Entities\Stickers\StickerSet;
use U89Man\TBot\Entities\Update;
use U89Man\TBot\Entities\User;
use U89Man\TBot\Entities\UserProfilePhotos;
use U89Man\TBot\Entities\WebhookInfo;

/**
 * API: 5.5
 *
 * @link https://core.telegram.org/bots/api-changelog#december-7-2021
 */
class Api
{
    /**
     * @var string
     */
    const URL = 'https://api.telegram.org/bot';

    /**
     * @var string
     */
    const FILE_URL = 'https://api.telegram.org/file/bot';


    /**
     * @var string
     */
    protected $token;


    /**
     * @param string $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * @param string $method
     * @param array $data
     *
     * @return mixed
     */
    protected function call($method, array $data = array())
    {
        $request = new Request(self::URL.$this->token.'/'.$method, $data);

        return $request->send()->getResult();
    }

    /* ------------------------ Обновления ------------------------ */

    /**
     * Получает массив входящих обновлений.
     *
     * @link https://core.telegram.org/bots/api#getupdates
     *
     * @param int|null $offset
     * @param int|null $limit
     * @param int|null $timeout
     * @param string|string[]|null $allowedUpdates
     *
     * @return Update[]
     */
    public function getUpdates(
        $offset = null,
        $limit = null,
        $timeout = null,
        $allowedUpdates = null
    ) {
        if ($allowedUpdates !== null) {
            $allowedUpdates = Utils::toJson(Utils::wrap($allowedUpdates));
        }

        return Utils::makeArray(Update::class, $this->call('getUpdates', [
            'offset' => $offset,
            'limit' => Utils::checkNum($limit, 1, 100, false, 100),
            'timeout' => $timeout,
            'allowed_updates' => $allowedUpdates
        ]));
    }

    /**
     * Устанавливает Webhook для получения входящих обновлений.
     *
     * @link https://core.telegram.org/bots/api#setwebhook
     *
     * @param string $url
     * @param string|null $ipAddress
     * @param InputFile|null $certificate
     * @param int|null $maxConnections
     * @param string|string[]|null $allowedUpdates
     * @param bool|null $dropPendingUpdates
     *
     * @return bool
     */
    public function setWebhook(
        $url,
        $ipAddress = null,
        $certificate = null,
        $maxConnections = null,
        $allowedUpdates = null,
        $dropPendingUpdates = null
    ) {
        if ($allowedUpdates !== null) {
            $allowedUpdates = Utils::toJson(Utils::wrap($allowedUpdates));
        }

        return $this->call('setWebhook', [
            'url' => $url,
            'ip_address ' => $ipAddress,
            'certificate' => $certificate,
            'max_connections' => Utils::checkNum($maxConnections, 1, 100, false, 40),
            'allowed_updates' => $allowedUpdates,
            'drop_pending_updates' => $dropPendingUpdates
        ]);
    }

    /**
     * Удаляет Webhook.
     *
     * @link https://core.telegram.org/bots/api#deletewebhook
     *
     * @param bool|null $dropPendingUpdates
     *
     * @return bool
     */
    public function deleteWebhook(
        $dropPendingUpdates = null
    ) {
        return $this->call('deleteWebhook', [
            'drop_pending_updates' => $dropPendingUpdates
        ]);
    }

    /**
     * Получает информацию о текущем Webhook.
     *
     * @link https://core.telegram.org/bots/api#getwebhookinfo
     *
     * @return WebhookInfo
     */
    public function getWebhookInfo()
    {
        return new WebhookInfo($this->call('getWebhookInfo'));
    }

    /* ------------------------ Сообщения ------------------------ */

    /**
     * @param string $method
     * @param array $data
     *
     * @return Message|bool|null
     */
    protected function _message($method, array $data = array())
    {
        $res = $this->call($method, $data);

        return is_array($res) ? new Message($res) : (is_bool($res) ? $res : null);
    }

    /**
     * Копирует любое сообщение.
     * Метод аналогичен методу "forwardMessages", но скопированное сообщение не имеет ссылки на исходное сообщение.
     *
     * @link https://core.telegram.org/bots/api#copymessage
     *
     * @param int|string $chatId
     * @param int|string $fromChatId
     * @param int $messageId
     * @param string|null $caption
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param string|null $parseMode
     * @param MessageEntity[]|null $captionEntities
     * @param bool|null $disableNotification
     * @param int|null $replyToMessageId
     * @param bool|null $allowSendingWithoutReply
     *
     * @return MessageId
     */
    public function copyMessage(
        $chatId,
        $fromChatId,
        $messageId,
        $caption = null,
        $replyMarkup = null,
        $parseMode = null,
        $captionEntities = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $allowSendingWithoutReply = null
    ) {
        return new MessageId($this->call('copyMessage', [
            'chat_id' => $chatId,
            'from_chat_id' => $fromChatId,
            'message_id' => $messageId,
            'caption' => Utils::checkStr($caption, 0, 1024),
            'parse_mode' => $parseMode,
            'caption_entities' => Utils::toJsonOrNull($captionEntities),
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'allow_sending_without_reply' => $allowSendingWithoutReply,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]));
    }

    /**
     * Отправляет тестовое сообщение.
     *
     * @link https://core.telegram.org/bots/api#sendmessage
     *
     * @param int|string $chatId
     * @param string $text
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param string|null $parseMode
     * @param MessageEntity[]|null $entities
     * @param bool|null $disableWebPagePreview
     * @param bool|null $disableNotification
     * @param bool|null $protectContent
     * @param int|null $replyToMessageId
     * @param bool|null $allowSendingWithoutReply
     *
     * @return Message
     */
    public function sendMessage(
        $chatId,
        $text,
        $replyMarkup = null,
        $parseMode = null,
        $entities = null,
        $disableWebPagePreview = null,
        $disableNotification = null,
        $protectContent = null,
        $replyToMessageId = null,
        $allowSendingWithoutReply = null
    ) {
        return new Message($this->call('sendMessage', [
            'chat_id' => $chatId,
            'text' => Utils::checkStr($text, 1, 4096, true),
            'parse_mode' => $parseMode,
            'entities' => Utils::toJsonOrNull($entities),
            'reply_markup' => Utils::toJsonOrNull($replyMarkup),
            'disable_web_page_preview' => $disableWebPagePreview,
            'disable_notification' => $disableNotification,
            'protect_content' => $protectContent,
            'allow_sending_without_reply' => $allowSendingWithoutReply,
            'reply_to_message_id' => $replyToMessageId
        ]));
    }

    /**
     * Отправляет аудиофайл.
     *
     * @link https://core.telegram.org/bots/api#sendaudio
     *
     * @param int|string $chatId
     * @param InputFile|string $audio
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param string|null $caption
     * @param string|null $parseMode
     * @param MessageEntity[]|null $captionEntities
     * @param int|null $duration
     * @param string|null $performer
     * @param string|null $title
     * @param InputFile|string|null $thumb
     * @param bool|null $disableNotification
     * @param int|null $replyToMessageId
     * @param bool|null $allowSendingWithoutReply
     *
     * @return Message
     */
    public function sendAudio(
        $chatId,
        $audio,
        $replyMarkup = null,
        $caption = null,
        $parseMode = null,
        $captionEntities = null,
        $duration = null,
        $performer = null,
        $title = null,
        $thumb = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $allowSendingWithoutReply = null
    ) {
        return new Message($this->call('sendAudio', [
            'chat_id' => $chatId,
            'audio' => $audio,
            'caption' => Utils::checkStr($caption, 0, 1024),
            'parse_mode' => $parseMode,
            'caption_entities' => Utils::toJsonOrNull($captionEntities),
            'duration' => $duration,
            'performer' => $performer,
            'title' => $title,
            'thumb' => $thumb,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'allow_sending_without_reply' => $allowSendingWithoutReply,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]));
    }

    /**
     * Отправляет файл анимации (видео в формате GIF или H.264/MPEG-4 AVC без звука).
     *
     * @link https://core.telegram.org/bots/api#sendanimation
     *
     * @param int|string $chatId
     * @param InputFile|string $animation
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param int|null $duration
     * @param int|null $width
     * @param int|null $height
     * @param InputFile|string|null $thumb
     * @param string|null $caption
     * @param string|null $parseMode
     * @param MessageEntity[]|null $captionEntities
     * @param bool|null $disableNotification
     * @param int|null $replyToMessageId
     * @param bool|null $allowSendingWithoutReply
     *
     * @return Message
     */
    public function sendAnimation(
        $chatId,
        $animation,
        $replyMarkup = null,
        $duration = null,
        $width = null,
        $height = null,
        $thumb = null,
        $caption = null,
        $parseMode = null,
        $captionEntities = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $allowSendingWithoutReply = null
    ) {
        return new Message($this->call('sendAnimation', [
            'chat_id' => $chatId,
            'animation' => $animation,
            'duration' => $duration,
            'width' => $width,
            'height' => $height,
            'thumb' => $thumb,
            'caption' => Utils::checkStr($caption, 0, 1024),
            'parse_mode' => $parseMode,
            'caption_entities' => Utils::toJsonOrNull($captionEntities),
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'allow_sending_without_reply' => $allowSendingWithoutReply,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]));
    }

    /**
     * Отправляет видео файл.
     *
     * @link https://core.telegram.org/bots/api#sendvideo
     *
     * @param int|string $chatId
     * @param InputFile|string $video
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param int|null $duration
     * @param int|null $width
     * @param int|null $height
     * @param InputFile|string|null $thumb
     * @param string|null $caption
     * @param string|null $parseMode
     * @param MessageEntity[]|null $captionEntities
     * @param bool|null $supportsStreaming
     * @param bool|null $disableNotification
     * @param int|null $replyToMessageId
     * @param bool|null $allowSendingWithoutReply
     *
     * @return Message
     */
    public function sendVideo(
        $chatId,
        $video,
        $replyMarkup = null,
        $duration = null,
        $width = null,
        $height = null,
        $thumb = null,
        $caption = null,
        $parseMode = null,
        $captionEntities = null,
        $supportsStreaming = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $allowSendingWithoutReply = null
    ) {
        return new Message($this->call('sendVideo', [
            'chat_id' => $chatId,
            'video' => $video,
            'duration' => $duration,
            'width' => $width,
            'height' => $height,
            'thumb' => $thumb,
            'caption' => Utils::checkStr($caption, 0, 1024),
            'parse_mode' => $parseMode,
            'caption_entities' => Utils::toJsonOrNull($captionEntities),
            'supports_streaming' => $supportsStreaming,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'allow_sending_without_reply' => $allowSendingWithoutReply,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]));
    }

    /**
     * Отправляет видео заметку.
     *
     * @link https://core.telegram.org/bots/api#sendvideonote
     *
     * @param int|string $chatId
     * @param InputFile|string $videoNote
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param int|null $duration
     * @param int|null $length
     * @param InputFile|string|null $thumb
     * @param bool|null $disableNotification
     * @param int|null $replyToMessageId
     * @param bool|null $allowSendingWithoutReply
     *
     * @return Message
     */
    public function sendVideoNote(
        $chatId,
        $videoNote,
        $replyMarkup = null,
        $duration = null,
        $length = null,
        $thumb = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $allowSendingWithoutReply = null
    ) {
        return new Message($this->call('sendVideoNote', [
            'chat_id' => $chatId,
            'video_note' => $videoNote,
            'duration' => $duration,
            'length' => $length,
            'thumb' => $thumb,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'allow_sending_without_reply' => $allowSendingWithoutReply,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]));
    }

    /**
     * Отправляет голосовое сообщение.
     *
     * @link https://core.telegram.org/bots/api#sendvoice
     *
     * @param int|string $chatId
     * @param InputFile|string $voice
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param int|null $duration
     * @param string|null $caption
     * @param string|null $parseMode
     * @param MessageEntity[]|null $captionEntities
     * @param bool|null $disableNotification
     * @param int|null $replyToMessageId
     * @param bool|null $allowSendingWithoutReply
     *
     * @return Message
     */
    public function sendVoice(
        $chatId,
        $voice,
        $replyMarkup = null,
        $duration = null,
        $caption = null,
        $parseMode = null,
        $captionEntities = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $allowSendingWithoutReply = null
    ) {
        return new Message($this->call('sendVoice', [
            'chat_id' => $chatId,
            'voice' => $voice,
            'duration' => $duration,
            'caption' => Utils::checkStr($caption, 0, 1024),
            'parse_mode' => $parseMode,
            'caption_entities' => Utils::toJsonOrNull($captionEntities),
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'allow_sending_without_reply' => $allowSendingWithoutReply,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]));
    }

    /**
     * Отправляет информацию о месте проведения.
     *
     * @link https://core.telegram.org/bots/api#sendvenue
     *
     * @param int|string $chatId
     * @param float $latitude
     * @param float $longitude
     * @param string $title
     * @param string $address
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param string|null $googlePlaceId
     * @param string|null $googlePlaceType
     * @param string|null $foursquareId
     * @param string|null $foursquareType
     * @param bool|null $disableNotification
     * @param int|null $replyToMessageId
     * @param bool|null $allowSendingWithoutReply
     *
     * @return Message
     */
    public function sendVenue(
        $chatId,
        $latitude,
        $longitude,
        $title,
        $address,
        $replyMarkup = null,
        $googlePlaceId = null,
        $googlePlaceType = null,
        $foursquareId = null,
        $foursquareType = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $allowSendingWithoutReply = null
    ) {
        return new Message($this->call('sendVenue', [
            'chat_id' => $chatId,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'title' => $title,
            'address' => $address,
            'foursquare_id' => $foursquareId,
            'foursquare_type' => $foursquareType,
            'google_place_id' => $googlePlaceId,
            'google_place_type' => $googlePlaceType,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'allow_sending_without_reply' => $allowSendingWithoutReply,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]));
    }

    /**
     * Отправляет стикер.
     *
     * @link https://core.telegram.org/bots/api#sendsticker
     *
     * @param int|string $chatId
     * @param InputFile|string $sticker
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param bool|null $disableNotification
     * @param int|null $replyToMessageId
     * @param bool|null $allowSendingWithoutReply
     *
     * @return Message
     */
    public function sendSticker(
        $chatId,
        $sticker,
        $replyMarkup = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $allowSendingWithoutReply = null
    ) {
        return new Message($this->call('sendSticker', [
            'chat_id' => $chatId,
            'sticker' => $sticker,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'allow_sending_without_reply' => $allowSendingWithoutReply,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]));
    }

    /**
     * Отправляет счет на оплату.
     *
     * @link https://core.telegram.org/bots/api#sendinvoice
     *
     * @param int $chatId
     * @param string $title
     * @param string $description
     * @param string $payload
     * @param string $providerToken
     * @param string $currency
     * @param LabeledPrice[] $prices
     * @param int|null $maxTipAmount
     * @param int[]|null $suggestedTipAmounts
     * @param string|null $startParameter
     * @param InlineKeyboardMarkup|null $replyMarkup
     * @param string |null $providerData
     * @param string |null $photoUrl
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
     * @param bool|null $disableNotification
     * @param int|null $replyToMessageId
     * @param bool|null $allowSendingWithoutReply
     *
     * @return Message
     * @throws Exceptions\ValueException
     */
    public function sendInvoice(
        $chatId,
        $title,
        $description,
        $payload,
        $providerToken,
        $currency,
        $prices,
        $maxTipAmount = null,
        $suggestedTipAmounts = null,
        $startParameter = null,
        $replyMarkup = null,
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
        $isFlexible = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $allowSendingWithoutReply = null
    ) {
        return new Message($this->call('sendInvoice', [
            'chat_id' => $chatId,
            'title' => Utils::checkStr($title, 1, 32, true),
            'description' => Utils::checkStr($description, 1, 255, true),
            'payload' => $payload,
            'provider_token' => $providerToken,
            'start_parameter' => $startParameter,
            'currency' => $currency,
            'prices' => Utils::toJson($prices),
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
            'is_flexible' => $isFlexible,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'allow_sending_without_reply' => $allowSendingWithoutReply,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]));
    }

    /**
     * Отправляет телефонный контакт.
     *
     * @link https://core.telegram.org/bots/api#sendcontact
     *
     * @param int|string $chatId
     * @param string $phoneNumber
     * @param string $firstName
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param string|null $lastName
     * @param string|null $vcard
     * @param bool|null $disableNotification
     * @param int|null $replyToMessageId
     * @param bool|null $allowSendingWithoutReply
     *
     * @return Message
     */
    public function sendContact(
        $chatId,
        $phoneNumber,
        $firstName,
        $replyMarkup = null,
        $lastName = null,
        $vcard = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $allowSendingWithoutReply = null
    ) {
        return new Message($this->call('sendContact', [
            'chat_id' => $chatId,
            'phone_number' => $phoneNumber,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'vcard' => $vcard,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'allow_sending_without_reply' => $allowSendingWithoutReply,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]));
    }

    /**
     * Отправляет простой файл.
     *
     * @link https://core.telegram.org/bots/api#senddocument
     *
     * @param int|string $chatId
     * @param InputFile|string $document
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param InputFile|string|null $thumb
     * @param string|null $caption
     * @param string|null $parseMode
     * @param MessageEntity[]|null $captionEntities
     * @param bool|null $disableContentTypeDetection
     * @param bool|null $disableNotification
     * @param int|null $replyToMessageId
     * @param bool|null $allowSendingWithoutReply
     *
     * @return Message
     */
    public function sendDocument(
        $chatId,
        $document,
        $replyMarkup = null,
        $thumb = null,
        $caption = null,
        $parseMode = null,
        $captionEntities = null,
        $disableContentTypeDetection = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $allowSendingWithoutReply = null
    ) {
        return new Message($this->call('sendDocument', [
            'chat_id' => $chatId,
            'document' => $document,
            'thumb' => $thumb,
            'caption' => Utils::checkStr($caption, 0, 1024),
            'parse_mode' => $parseMode,
            'caption_entities' => Utils::toJsonOrNull($captionEntities),
            'disable_content_type_detection' => $disableContentTypeDetection,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'allow_sending_without_reply' => $allowSendingWithoutReply,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]));
    }

    /**
     * Отправляет фотографию.
     *
     * @link https://core.telegram.org/bots/api#sendphoto
     *
     * @param int|string $chatId
     * @param InputFile|string $photo
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param string|null $caption
     * @param string|null $parseMode
     * @param MessageEntity[]|null $captionEntities
     * @param bool|null $disableNotification
     * @param int|null $replyToMessageId
     * @param bool|null $allowSendingWithoutReply
     *
     * @return Message
     */
    public function sendPhoto(
        $chatId,
        $photo,
        $replyMarkup = null,
        $caption = null,
        $parseMode = null,
        $captionEntities = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $allowSendingWithoutReply = null
    ) {
        return new Message($this->call('sendPhoto', [
            'chat_id' => $chatId,
            'photo' => $photo,
            'caption' => Utils::checkStr($caption, 0, 1024),
            'parse_mode' => $parseMode,
            'caption_entities' => Utils::toJsonOrNull($captionEntities),
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'allow_sending_without_reply' => $allowSendingWithoutReply,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]));
    }

    /**
     * Отправляет игру.
     *
     * @link https://core.telegram.org/bots/api#sendgame
     *
     * @param int|string $chatId
     * @param string $gameShortName
     * @param InlineKeyboardMarkup|null $replyMarkup
     * @param bool|null $disableNotification
     * @param int|null $replyToMessageId
     * @param bool|null $allowSendingWithoutReply
     *
     * @return Message
     */
    public function sendGame(
        $chatId,
        $gameShortName,
        $replyMarkup = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $allowSendingWithoutReply = null
    ) {
        return new Message($this->call('sendGame', [
            'chat_id' => $chatId,
            'game_short_name' => $gameShortName,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'allow_sending_without_reply' => $allowSendingWithoutReply,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]));
    }

    /**
     * Отправляет анимированный смайлик, который будет отображать случайное значение.
     *
     * @link https://core.telegram.org/bots/api#senddice
     *
     * @param int|string $chatId
     * @param string|null $emoji
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param bool|null $disableNotification
     * @param int|null $replyToMessageId
     * @param bool|null $allowSendingWithoutReply
     *
     * @return Message
     */
    public function sendDice(
        $chatId,
        $emoji = null,
        $replyMarkup = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $allowSendingWithoutReply = null
    ) {
        return new Message($this->call('sendDice', [
            'chat_id' => $chatId,
            'emoji' => $emoji,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'allow_sending_without_reply' => $allowSendingWithoutReply,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]));
    }

    /**
     * Отправляет опрос.
     *
     * @link https://core.telegram.org/bots/api#sendpoll
     *
     * @param int|string $chatId
     * @param string $question
     * @param string[] $options
     * @param bool|null $isAnonymous
     * @param string|null $type
     * @param bool|null $allowsMultipleAnswers
     * @param int|null $correctOptionId
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param string|null $explanation
     * @param string|null $explanationParseMode
     * @param MessageEntity[]|null $explanationEntities
     * @param int|null $openPeriod
     * @param int|null $closeDate
     * @param bool|null $isClosed
     * @param bool|null $disableNotification
     * @param int|null $replyToMessageId
     * @param bool|null $allowSendingWithoutReply
     *
     * @return Message
     */
    public function sendPoll(
        $chatId,
        $question,
        $options,
        $isAnonymous = null,
        $type = null,
        $allowsMultipleAnswers = null,
        $correctOptionId = null,
        $replyMarkup = null,
        $explanation = null,
        $explanationParseMode = null,
        $explanationEntities = null,
        $openPeriod = null,
        $closeDate = null,
        $isClosed = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $allowSendingWithoutReply = null
    ) {
        return new Message($this->call('sendPoll', [
            'chat_id' => $chatId,
            'question' => Utils::checkStr($question, 1, 300, true),
            'options' => Utils::toJson($options),
            'is_anonymous' => $isAnonymous,
            'type' => $type,
            'allows_multiple_answers' => $allowsMultipleAnswers,
            'correct_option_id' => Utils::checkNum($correctOptionId, 0),
            'explanation' => Utils::checkStr($explanation, 0, 200),
            'explanation_parse_mode' => $explanationParseMode,
            'explanation_entities' => $explanationEntities,
            'open_period' => Utils::checkNum($openPeriod, 5, 600),
            'close_date' => $closeDate,
            'is_closed' => $isClosed,
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'allow_sending_without_reply' => $allowSendingWithoutReply,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]));
    }

    /**
     * Останавливает отправленный ранее опрос.
     *
     * @link https://core.telegram.org/bots/api#stoppoll
     *
     * @param int|string $chatId
     * @param int $messageId
     * @param InlineKeyboardMarkup|null $replyMarkup
     *
     * @return Poll
     */
    public function stopPoll(
        $chatId,
        $messageId,
        $replyMarkup = null
    ) {
        return new Poll($this->call('stopPoll', [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]));
    }

    /**
     * Отправляет местоположение.
     *
     * @link https://core.telegram.org/bots/api#sendlocation
     *
     * @param int|string $chatId
     * @param float $latitude
     * @param float $longitude
     * @param float|null $horizontalAccuracy
     * @param int|null $livePeriod
     * @param int|null $heading
     * @param int|null $proximityAlertRadius
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup
     * @param bool|null $disableNotification
     * @param int|null $replyToMessageId
     * @param bool|null $allowSendingWithoutReply
     *
     * @return Message
     */
    public function sendLocation(
        $chatId,
        $latitude,
        $longitude,
        $horizontalAccuracy = null,
        $livePeriod = null,
        $heading = null,
        $proximityAlertRadius = null,
        $replyMarkup = null,
        $disableNotification = null,
        $replyToMessageId = null,
        $allowSendingWithoutReply = null
    ) {
        return new Message($this->call('sendLocation', [
            'chat_id' => $chatId,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'horizontal_accuracy' => Utils::checkNum($horizontalAccuracy, 0, 1500),
            'live_period' => Utils::checkNum($livePeriod, 60, 86400),
            'heading' => Utils::checkNum($heading, 1, 360),
            'proximity_alert_radius' => Utils::checkNum($proximityAlertRadius, 1, 100000),
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'allow_sending_without_reply' => $allowSendingWithoutReply,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]));
    }

    /**
     * Редактирует сообщение о местоположении в реальном времени.
     *
     * @link https://core.telegram.org/bots/api#editmessagelivelocation
     *
     * @param float $latitude
     * @param float $longitude
     * @param int|string|null $chatId
     * @param int|null $messageId
     * @param string|null $inlineMessageId
     * @param float|null $horizontalAccuracy
     * @param int|null $heading
     * @param int|null $proximityAlertRadius
     * @param InlineKeyboardMarkup|null $replyMarkup
     *
     * @return Message|bool
     */
    public function editMessageLiveLocation(
        $latitude,
        $longitude,
        $chatId = null,
        $messageId = null,
        $inlineMessageId = null,
        $horizontalAccuracy = null,
        $heading = null,
        $proximityAlertRadius = null,
        $replyMarkup = null
    ) {
        return $this->_message('editMessageLiveLocation', [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'inline_message_id' => ($chatId !== null || $messageId !== null) ? null : $inlineMessageId,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'horizontal_accuracy' => Utils::checkNum($horizontalAccuracy, 0, 1500),
            'heading' => Utils::checkNum($heading, 1, 360),
            'proximity_alert_radius' => Utils::checkNum($proximityAlertRadius, 1, 100000),
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]);
    }

    /**
     * Остановливает обновление сообщения о текущем местоположении до истечения срока действия 'live_period'.
     *
     * @link https://core.telegram.org/bots/api#stopmessagelivelocation
     *
     * @param int|string|null $chatId
     * @param int|null $messageId
     * @param string|null $inlineMessageId
     * @param InlineKeyboardMarkup|null $replyMarkup
     *
     * @return Message|bool
     */
    public function stopMessageLiveLocation(
        $chatId = null,
        $messageId = null,
        $inlineMessageId = null,
        $replyMarkup = null
    ) {
        return $this->_message('stopMessageLiveLocation', [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'inline_message_id' => ($chatId !== null || $messageId !== null) ? null : $inlineMessageId,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]);
    }

    /**
     * Отправляет группу фотографий или видео в виде альбома.
     *
     * @link https://core.telegram.org/bots/api#sendmediagroup
     *
     * @param int|string $chatId
     * @param InputMediaPhoto[]|InputMediaVideo[]|InputMediaAudio[]|InputMediaDocument[] $media
     * @param bool|null $disableNotification
     * @param int|null $replyToMessageId
     * @param bool|null $allowSendingWithoutReply
     *
     * @return Message[]
     */
    public function sendMediaGroup(
        $chatId,
        $media,
        $disableNotification = null,
        $replyToMessageId = null,
        $allowSendingWithoutReply = null
    ) {
        return Utils::makeArray(Message::class, $this->call('sendMediaGroup', [
            'chat_id' => $chatId,
            'media' => Utils::toJson($media),
            'disable_notification' => $disableNotification,
            'reply_to_message_id' => $replyToMessageId,
            'allow_sending_without_reply' => $allowSendingWithoutReply
        ]));
    }

    /**
     * Редактирует медиа (анимация, аудио, документ, фото, видео) сообщение.
     *
     * @link https://core.telegram.org/bots/api#editmessagemedia
     *
     * @param InputMedia $media
     * @param int|string|null $chatId
     * @param int|null $messageId
     * @param string|null $inlineMessageId
     * @param InlineKeyboardMarkup|null $replyMarkup
     *
     * @return Message|bool
     */
    public function editMessageMedia(
        $media,
        $chatId = null,
        $messageId = null,
        $inlineMessageId = null,
        $replyMarkup = null
    ) {
        return $this->_message('editMessageMedia', [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'inline_message_id' => ($chatId !== null || $messageId !== null) ? null : $inlineMessageId,
            'media' => Utils::toJson($media),
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]);
    }

    /**
     * Пересылает сообщение.
     *
     * @link https://core.telegram.org/bots/api#forwardmessage
     *
     * @param int|string $chatId
     * @param int|string $fromChatId
     * @param int $messageId
     * @param bool|null $disableNotification
     *
     * @return Message
     */
    public function forwardMessage(
        $chatId,
        $fromChatId,
        $messageId,
        $disableNotification = null
    ) {
        return new Message($this->call('forwardMessage', [
            'chat_id' => $chatId,
            'from_chat_id' => $fromChatId,
            'disable_notification' => $disableNotification,
            'message_id' => $messageId
        ]));
    }
    
    /**
     * Редактирует подпись сообщения.
     *
     * @link https://core.telegram.org/bots/api#editmessagecaption
     *
     * @param int|string|null $chatId
     * @param int|null $messageId
     * @param string|null $inlineMessageId
     * @param string|null $caption
     * @param string|null $parseMode
     * @param MessageEntity[]|null $captionEntities
     * @param InlineKeyboardMarkup|null $replyMarkup
     *
     * @return Message|bool
     */
    public function editMessageCaption(
        $chatId = null,
        $messageId = null,
        $inlineMessageId = null,
        $caption = null,
        $parseMode = null,
        $captionEntities = null,
        $replyMarkup = null
    ) {
        return $this->_message('editMessageCaption', [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'inline_message_id' => ($chatId !== null || $messageId !== null) ? null : $inlineMessageId,
            'caption' => Utils::checkStr($caption, 0, 1024),
            'parse_mode' => $parseMode,
            'caption_entities' => Utils::toJsonOrNull($captionEntities),
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]);
    }

    /**
     * Редактирует текстовое или игровое сообщений.
     *
     * @link https://core.telegram.org/bots/api#editmessagetext
     *
     * @param string $text
     * @param int|string|null $chatId
     * @param int|null $messageId
     * @param string|null $inlineMessageId
     * @param InlineKeyboardMarkup|null $replyMarkup
     * @param string|null $parseMode
     * @param MessageEntity[]|null $entities
     * @param bool|null $disableWebPagePreview
     *
     * @return Message|bool
     */
    public function editMessageText(
        $text,
        $chatId = null,
        $messageId = null,
        $inlineMessageId = null,
        $replyMarkup = null,
        $parseMode = null,
        $entities = null,
        $disableWebPagePreview = null
    ) {
        return $this->_message('editMessageText', [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'inline_message_id' => ($chatId !== null || $messageId !== null) ? null : $inlineMessageId,
            'text' => Utils::checkStr($text, 1, 4096, true),
            'parse_mode' => $parseMode,
            'entities' => Utils::toJsonOrNull($entities),
            'disable_web_page_preview' => $disableWebPagePreview,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]);
    }

    /**
     * Редактирует разметку встроенной клавиатуры сообщениюя.
     *
     * @link https://core.telegram.org/bots/api#editmessagereplymarkup
     *
     * @param int|string|null $chatId
     * @param int|null $messageId
     * @param string|null $inlineMessageId
     * @param InlineKeyboardMarkup|null $replyMarkup
     *
     * @return Message|bool
     */
    public function editMessageReplyMarkup(
        $chatId = null,
        $messageId = null,
        $inlineMessageId = null,
        $replyMarkup = null
    ) {
        return $this->_message('editMessageReplyMarkup', [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'inline_message_id' => ($chatId !== null || $messageId !== null) ? null : $inlineMessageId,
            'reply_markup' => Utils::toJsonOrNull($replyMarkup)
        ]);
    }
    
    /**
     * Удаляет сообщения, включая служебные.
     *
     * @link https://core.telegram.org/bots/api#deletemessage
     *
     * @param int|string $chatId
     * @param int $messageId
     *
     * @return bool
     */
    public function deleteMessage(
        $chatId,
        $messageId
    ) {
        return $this->call('deleteMessage', [
            'chat_id' => $chatId,
            'message_id' => $messageId
        ]);
    }
    
    /* ------------------------ Чаты ------------------------ */

    /**
     * Устанавливает название для администратора в супергруппе, продвигаемой ботом.
     *
     * @link https://core.telegram.org/bots/api#setchatadministratorcustomtitle
     *
     * @param int|string $chatId
     * @param int $userId
     * @param string $customTitle
     *
     * @return bool
     */
    public function setChatAdministratorCustomTitle(
        $chatId,
        $userId,
        $customTitle
    ) {
        return $this->call('setChatAdministratorCustomTitle', [
            'chat_id' => $chatId,
            'user_id' => $userId,
            'custom_title' => Utils::checkStr($customTitle, 0, 16, true),
        ]);
    }

    /**
     * Повышает или понижает роль пользователя в супергруппе или на канале.
     *
     * @link https://core.telegram.org/bots/api#promotechatmember
     *
     * @param int|string $chatId
     * @param int $userId
     * @param bool|null $isAnonymous
     * @param bool|null $canManageChats
     * @param bool|null $canChangeInfo
     * @param bool|null $canPostMessages
     * @param bool|null $canEditMessages
     * @param bool|null $canDeleteMessages
     * @param bool|null $canManageVoiceChats
     * @param bool|null $canInviteUsers
     * @param bool|null $canRestrictMembers
     * @param bool|null $canPinMessages
     * @param bool|null $canPromoteMembers
     *
     * @return bool
     */
    public function promoteChatMember(
        $chatId,
        $userId,
        $isAnonymous = null,
        $canManageChats = null,
        $canChangeInfo = null,
        $canPostMessages = null,
        $canEditMessages = null,
        $canDeleteMessages = null,
        $canManageVoiceChats = null,
        $canInviteUsers = null,
        $canRestrictMembers = null,
        $canPinMessages = null,
        $canPromoteMembers = null
    ) {
        return $this->call('promoteChatMember', [
            'chat_id' => $chatId,
            'user_id' => $userId,
            'is_anonymous' => $isAnonymous,
            'can_manage_chat' => $canManageChats,
            'can_change_info' => $canChangeInfo,
            'can_post_messages' => $canPostMessages,
            'can_edit_messages' => $canEditMessages,
            'can_delete_messages' => $canDeleteMessages,
            'can_manage_voice_chats' => $canManageVoiceChats,
            'can_invite_users' => $canInviteUsers,
            'can_restrict_members' => $canRestrictMembers,
            'can_pin_messages' => $canPinMessages,
            'can_promote_members' => $canPromoteMembers
        ]);
    }

    /**
     * Ограничивает пользователя в супергруппе.
     *
     * @link https://core.telegram.org/bots/api#restrictchatmember
     *
     * @param int|string $chatId
     * @param int $userId
     * @param ChatPermissions $permissions
     * @param int|null $untilDate
     *
     * @return bool
     */
    public function restrictChatMember(
        $chatId,
        $userId,
        $permissions,
        $untilDate = null
    ) {
        return $this->call('restrictChatMember', [
            'chat_id' => $chatId,
            'user_id' => $userId,
            'permissions' => Utils::toJson($permissions),
            'until_date' => $untilDate
        ]);
    }

    /**
     * Исключает пользователя из группы, супергруппы или канала.
     * Переименован в banChatMember(). [5.3]
     *
     * @deprecated
     *
     * @param int|string $chatId
     * @param int $userId
     * @param int|null $untilDate
     * @param bool|null $revokeMessages
     *
     * @return bool
     */
    public function kickChatMember(
        $chatId,
        $userId,
        $untilDate = null,
        $revokeMessages = null
    ) {
        return $this->banChatMember($chatId, $userId, $untilDate, $revokeMessages);
    }

    /**
     * Исключает пользователя из группы, супергруппы или канала.
     *
     * @link https://core.telegram.org/bots/api#banchatmember
     *
     * @param int|string $chatId
     * @param int $userId
     * @param int|null $untilDate
     * @param bool|null $revokeMessages
     *
     * @return bool
     */
    public function banChatMember(
        $chatId,
        $userId,
        $untilDate = null,
        $revokeMessages = null
    ) {
        return $this->call('banChatMember', [
            'chat_id' => $chatId,
            'user_id' => $userId,
            'until_date' => $untilDate,
            'revoke_messages' => $revokeMessages
        ]);
    }

    /**
     * Разблокирует ранее удаленного пользователя в супергруппе или канале.
     * По умолчанию этот метод гарантирует, что после вызова пользователь не будет является участником чата,
     * но сможет присоединиться к нему.
     *
     * @link https://core.telegram.org/bots/api#unbanchatmember
     *
     * @param int|string $chatId
     * @param int $userId
     * @param bool|null $onlyIfBanned
     *
     * @return bool
     */
    public function unbanChatMember(
        $chatId,
        $userId,
        $onlyIfBanned = null
    ) {
        return $this->call('unbanChatMember', [
            'chat_id' => $chatId,
            'user_id' => $userId,
            'only_if_banned' => $onlyIfBanned
        ]);
    }

    /**
     * Используется для блокировки канального чата в супергруппе или на канале.
     *
     * Пока чат не будет разблокирован, владелец заблокированного чата не сможет отправлять сообщения
     * от имени любого из своих каналов.
     *
     * @link https://core.telegram.org/bots/api#banchatsenderchat
     *
     * @param int|string $chatId
     * @param string $senderChatId
     *
     * @return bool
     */
    public function banChatSenderChat(
        $chatId,
        $senderChatId
    ) {
        return (bool) $this->call('banChatSenderChat', [
            'chat_id' => $chatId,
            'sender_chat_id' => $senderChatId
        ]);
    }

    /**
     * Используется для разблокировки канального чата в супергруппе или на канале.
     *
     * @link https://core.telegram.org/bots/api#unbanchatsenderchat
     *
     * @param int|string $chatId
     * @param string $senderChatId
     *
     * @return bool
     */
    public function unbanChatSenderChat(
        $chatId,
        $senderChatId
    ) {
        return (bool) $this->call('unbanChatSenderChat', [
            'chat_id' => $chatId,
            'sender_chat_id' => $senderChatId
        ]);
    }

    /**
     * Изменяет заголовок чата.
     *
     * @link https://core.telegram.org/bots/api#setchattitle
     *
     * @param int|string $chatId
     * @param string $title
     *
     * @return bool
     */
    public function setChatTitle(
        $chatId,
        $title
    ) {
        return $this->call('setChatTitle', [
            'chat_id' => $chatId,
            'title' => Utils::checkStr($title, 1, 255, true),
        ]);
    }

    /**
     * Устанавливает новую фотографию профиля для чата.
     *
     * @link https://core.telegram.org/bots/api#setchatphoto
     *
     * @param int|string $chatId
     * @param InputFile $photo
     *
     * @return bool
     */
    public function setChatPhoto(
        $chatId,
        $photo
    ) {
        return $this->call('setChatPhoto', [
            'chat_id' => $chatId,
            'photo' => $photo
        ]);
    }

    /**
     * Удаляет фотографию профиля чата.
     *
     * @link https://core.telegram.org/bots/api#deletechatphoto
     *
     * @param int|string $chatId
     *
     * @return bool
     */
    public function deleteChatPhoto(
        $chatId
    ) {
        return $this->call('deleteChatPhoto', [
            'chat_id' => $chatId
        ]);
    }

    /**
     * Изменяет описание группы, супергруппы или канала.
     *
     * @link https://core.telegram.org/bots/api#setchatdescription
     *
     * @param int|string $chatId
     * @param string $description
     *
     * @return bool
     */
    public function setChatDescription(
        $chatId,
        $description
    ) {
        return $this->call('setChatDescription', [
            'chat_id' => $chatId,
            'description' => Utils::checkStr($description, 0, 255)
        ]);
    }

    /**
     * Устанавливает разрешения чата по умолчанию для всех участников.
     *
     * @link https://core.telegram.org/bots/api#setchatpermissions
     *
     * @param int|string $chatId
     * @param ChatPermissions $permissions
     *
     * @return bool
     */
    public function setChatPermissions(
        $chatId,
        $permissions
    ) {
        return $this->call('setChatPermissions', [
            'chat_id' => $chatId,
            'permissions' => Utils::toJson($permissions)
        ]);
    }

    /**
     * Закрепляет сообщение в группе, супергруппе или канале.
     *
     * @link https://core.telegram.org/bots/api#pinchatmessage
     *
     * @param int|string $chatId
     * @param int $messageId
     * @param bool|null $disableNotification
     *
     * @return bool
     */
    public function pinChatMessage(
        $chatId,
        $messageId,
        $disableNotification = null
    ) {
        return $this->call('pinChatMessage', [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'disable_notification' => $disableNotification,
        ]);
    }

    /**
     * Открепляет указанное сообщение в группе, супергруппе или канале.
     *
     * Если не указан идентификатор сообщения,
     * будет откреплено самое последнее закрепленное сообщение (по дате отправки).
     *
     * @link https://core.telegram.org/bots/api#unpinchatmessage
     *
     * @param int|string $chatId
     * @param int $messageId
     *
     * @return bool
     */
    public function unpinChatMessage(
        $chatId,
        $messageId = null
    ) {
        return $this->call('unpinChatMessage', [
            'chat_id' => $chatId,
            'message_id' => $messageId
        ]);
    }

    /**
     * Очищает список закрепленных сообщений в чате.
     *
     * @link https://core.telegram.org/bots/api#unpinallchatmessages
     *
     * @param int|string $chatId
     *
     * @return bool
     */
    public function unpinAllChatMessages(
        $chatId
    ) {
        return $this->call('unpinAllChatMessages', [
            'chat_id' => $chatId
        ]);
    }

    /**
     * Получает информацию о чате.
     *
     * @link https://core.telegram.org/bots/api#getchat
     *
     * @param int|string $chatId
     *
     * @return Chat
     */
    public function getChat(
        $chatId
    ) {
        return new Chat($this->call('getChat', [
            'chat_id' => $chatId
        ]));
    }

    /**
     * Сообщает пользователю, что что-то происходит на стороне бота.
     *
     * @link https://core.telegram.org/bots/api#sendchataction
     *
     * @param int|string $chatId
     * @param string $action
     *
     * @return bool
     */
    public function sendChatAction(
        $chatId,
        $action
    ) {
        return $this->call('sendChatAction', [
            'chat_id' => $chatId,
            'action' => $action
        ]);
    }

    /**
     * Получает информацию об участнике чата.
     *
     * @link https://core.telegram.org/bots/api#getchatmember
     *
     * @param int|string $chatId
     * @param int $userId
     *
     * @return ChatMember
     */
    public function getChatMember(
        $chatId,
        $userId
    ) {
        return ChatMember::getConcreteEntity($this->call('getChatMember', [
            'chat_id' => $chatId,
            'user_id' => $userId
        ]));
    }

    /**
     * Получает информацию обо всех администраторах чата, кроме других ботов.
     *
     * @link https://core.telegram.org/bots/api#getchatadministrators
     *
     * @param int|string $chatId
     *
     * @return ChatMember[]
     */
    public function getChatAdministrators(
        $chatId
    ) {
        $data = $this->call('getChatAdministrators', [
            'chat_id' => $chatId
        ]);

        $arr = array();

        foreach ($data as $d) {
            $arr[] = ChatMember::getConcreteEntity($d);
        }

        return $arr;
    }

    /**
     * Получает количество участников чата.
     * Переименован в getChatMemberCount() [5.3]
     *
     * @deprecated
     *
     * @param int|string $chatId
     *
     * @return int
     */
    public function getChatMembersCount(
        $chatId
    ) {
        return $this->getChatMemberCount($chatId);
    }

    /**
     * Получает количество участников чата.
     *
     * @link https://core.telegram.org/bots/api#getchatmembercount
     *
     * @param int|string $chatId
     *
     * @return int
     */
    public function getChatMemberCount(
        $chatId
    ) {
        return $this->call('getChatMembersCount', [
            'chat_id' => $chatId
        ]);
    }

    /**
     * Создает новую ссылку для приглашения в чат; любая ранее созданная ссылка аннулируется.
     *
     * @link https://core.telegram.org/bots/api#exportchatinvitelink
     *
     * @param int|string $chatId
     *
     * @return string
     */
    public function exportChatInviteLink(
        $chatId
    ) {
        return $this->call('exportChatInviteLink', [
            'chat_id' => $chatId
        ]);
    }

    /**
     * Создает дополнительную ссылку для приглашения в чат. Ссылку можно отозвать с помощью метода 'revokeChatInviteLink'.
     *
     * @link https://core.telegram.org/bots/api#createchatinvitelink
     *
     * @param int|string $chatId
     * @param string|null $name
     * @param int|null $expireDate
     * @param int|null $memberLimit
     * @param bool|null $createsJoinRequest
     *
     * @return ChatInviteLink
     */
    public function createChatInviteLink(
        $chatId,
        $name = null,
        $expireDate = null,
        $memberLimit = null,
        $createsJoinRequest = null
    ) {
        return new ChatInviteLink($this->call('createChatInviteLink', [
            'chat_id' => $chatId,
            'name' => Utils::checkStr($name, 0, 32),
            'expire_date' => $expireDate,
            'member_limit' => Utils::checkNum($memberLimit, 1, 99999),
            'creates_join_request' => $createsJoinRequest
        ]));
    }

    /**
     * Редактирует дополнительную пригласительную ссылку, созданную ботом.
     *
     * @link https://core.telegram.org/bots/api#editchatinvitelink
     *
     * @param int|string $chatId
     * @param string $inviteLink
     * @param string|null $name
     * @param int|null $expireDate
     * @param int|null $memberLimit
     * @param bool|null $createsJoinRequest
     *
     * @return ChatInviteLink
     */
    public function editChatInviteLink(
        $chatId,
        $inviteLink,
        $name = null,
        $expireDate = null,
        $memberLimit = null,
        $createsJoinRequest = null
    ) {
        return new ChatInviteLink($this->call('editChatInviteLink', [
            'chat_id' => $chatId,
            'name' => Utils::checkStr($name, 0, 32),
            'invite_link' => $inviteLink,
            'expire_date' => $expireDate,
            'member_limit' => Utils::checkNum($memberLimit, 1, 99999),
            'creates_join_request' => $createsJoinRequest
        ]));
    }

    /**
     * Отзывает пригласительную ссылку, созданную ботом.
     * Если основная ссылка отозвана, автоматически создается новая ссылка.
     *
     * @link https://core.telegram.org/bots/api#revokechatinvitelink
     *
     * @param int|string $chatId
     * @param string $inviteLink
     *
     * @return ChatInviteLink
     */
    public function revokeChatInviteLink(
        $chatId,
        $inviteLink
    ) {
        return new ChatInviteLink($this->call('revokeChatInviteLink', [
            'chat_id' => $chatId,
            'invite_link' => $inviteLink
        ]));
    }

    /**
     * Используется для одобрения запроса на присоединение пользователя к чату.
     *
     * @link https://core.telegram.org/bots/api#approvechatjoinrequest
     *
     * @param int|string $chatId
     * @param int $userId
     *
     * @return bool
     */
    public function approveChatJoinRequest(
        $chatId,
        $userId
    ) {
        return $this->call('approveChatJoinRequest', [
            'chat_id' => $chatId,
            'user_id' => $userId
        ]);
    }

    /**
     * Используется для отклонения запроса на присоединение пользователя к чату.
     *
     * @link https://core.telegram.org/bots/api#declinechatjoinrequest
     *
     * @param int|string $chatId
     * @param int $userId
     *
     * @return bool
     */
    public function declineChatJoinRequest(
        $chatId,
        $userId
    ) {
        return $this->call('declineChatJoinRequest', [
            'chat_id' => $chatId,
            'user_id' => $userId
        ]);
    }

    /**
     * Используется для выхода бота из группы, супергруппы или канала.
     *
     * @link https://core.telegram.org/bots/api#leavechat
     *
     * @param int|string $chatId
     *
     * @return bool
     */
    public function leaveChat(
        $chatId
    ) {
        return $this->call('leaveChat', [
            'chat_id' => $chatId
        ]);
    }

    /* ------------------------ Стикеры ------------------------ */

    /**
     * Создает новый набор стикеров, принадлежащий пользователю.
     *
     * @link https://core.telegram.org/bots/api#createnewstickerset
     *
     * @param int $userId
     * @param string $name
     * @param string $title
     * @param string $emojis
     * @param InputFile|string|null $pngSticker
     * @param InputFile|null $tgsSticker
     * @param bool|null $containsMasks
     * @param MaskPosition|null $maskPosition
     *
     * @return bool
     */
    public function createNewStickerSet(
        $userId,
        $name,
        $title,
        $emojis,
        $pngSticker = null,
        $tgsSticker = null,
        $containsMasks = null,
        $maskPosition = null
    ) {
       return $this->call('createNewStickerSet', [
           'user_id' => $userId,
           'name' => Utils::checkStr($name, 1, 64, true),
           'title' => Utils::checkStr($title, 1, 64, true),
           'png_sticker' => $pngSticker,
           'tgs_sticker' => $pngSticker !== null ? null : $tgsSticker,
           'emojis' => $emojis,
           'contains_masks' => $containsMasks,
           'mask_position' => $maskPosition
       ]) ;
    }

    /**
     * Добавляет новый стикер в набор, созданный ботом.
     *
     * @link https://core.telegram.org/bots/api#addstickertoset
     *
     * @param int $userId
     * @param string $name
     * @param string $emojis
     * @param InputFile|string|null $pngSticker
     * @param InputFile|null $tgsSticker
     * @param MaskPosition|null $maskPosition
     *
     * @return bool
     */
    public function addStickerToSet(
        $userId,
        $name,
        $emojis,
        $pngSticker = null,
        $tgsSticker = null,
        $maskPosition = null
    ) {
        return $this->call('addStickerToSet', [
            'user_id' => $userId,
            'name' => $name,
            'png_sticker' => $pngSticker,
            'tgs_sticker' => $pngSticker !== null ? null : $tgsSticker,
            'emojis' => $emojis,
            'mask_position' => $maskPosition
        ]) ;
    }

    /**
     * Перемещает стикер в наборе, созданном ботом, в определенное место.
     *
     * @link https://core.telegram.org/bots/api#setstickerpositioninset
     *
     * @param string $sticker
     * @param int $position
     *
     * @return bool
     */
    public function setStickerPositionInSet(
        $sticker,
        $position
    ) {
        return $this->call('setStickerPositionInSet', [
            'sticker' => $sticker,
            'position' => $position
        ]) ;
    }

    /**
     * Установливает эскиз набора стикеров.
     *
     * @link https://core.telegram.org/bots/api#setstickersetthumb
     *
     * @param string $name
     * @param int $userId
     * @param InputFile|string|null $thumb
     *
     * @return mixed
     */
    public function setStickerSetThumb(
        $name,
        $userId,
        $thumb = null
    ) {
        return $this->call('setStickerSetThumb', [
            'name' => $name,
            'user_id' => $userId,
            'thumb' => $thumb
        ]);
    }

    /**
     * Удаляет стикер из набора, созданного ботом.
     *
     * @link https://core.telegram.org/bots/api#deletestickerfromset
     *
     * @param string $sticker
     *
     * @return bool
     */
    public function deleteStickerFromSet(
        $sticker
    ) {
        return $this->call('deleteStickerFromSet', [
            'sticker' => $sticker
        ]);
    }

    /**
     * Получает набор стикеров.
     *
     * @link https://core.telegram.org/bots/api#getstickerset
     *
     * @param string $name
     *
     * @return StickerSet
     */
    public function getStickerSet(
        $name
    ) {
        return new StickerSet($this->call('getStickerSet', [
            'name' => $name
        ]));
    }

    /**
     * Загружает *.PNG файл со стикером для последующего использования.
     *
     * @link https://core.telegram.org/bots/api#uploadstickerfile
     *
     * @param int $userId
     * @param InputFile $pngSticker
     *
     * @return File
     */
    public function uploadStickerFile(
        $userId,
        $pngSticker
    ) {
        return new File($this->call('uploadStickerFile', [
            'user_id' => $userId,
            'png_sticker' => $pngSticker,
        ]));
    }

    /**
     * Устанавливает новый набор групповых стикеров для супергруппы.
     *
     * @link https://core.telegram.org/bots/api#setchatstickerset
     *
     * @param int|string $chatId
     * @param string $stickerSetName
     *
     * @return bool
     */
    public function setChatStickerSet(
        $chatId,
        $stickerSetName
    ) {
        return $this->call('setChatStickerSet', [
            'chat_id' => $chatId,
            'sticker_set_name' => $stickerSetName
        ]);
    }

    /**
     * Удаляет набор групповых стикеров из супергруппы.
     *
     * @link https://core.telegram.org/bots/api#deletechatstickerset
     *
     * @param int|string $chatId
     *
     * @return bool
     */
    public function deleteChatStickerSet(
        $chatId
    ) {
        return $this->call('deleteChatStickerSet', [
            'chat_id' => $chatId,
        ]);
    }

    /* ------------------------ Запросы ------------------------ */

    /**
     * Отправляет ответ на запрос обратного вызова.
     *
     * @link https://core.telegram.org/bots/api#answercallbackquery
     *
     * @param string $callbackQueryId
     * @param string|null $text
     * @param bool|null $showAlert
     * @param int|null $cacheTime
     * @param string|null $url
     *
     * @return bool
     */
    public function answerCallbackQuery(
        $callbackQueryId,
        $text = null,
        $showAlert = null,
        $cacheTime = null,
        $url = null
    ) {
        return $this->call('answerCallbackQuery', [
            'callback_query_id' => $callbackQueryId,
            'text' => Utils::checkStr($text, 0, 200),
            'show_alert' => $showAlert,
            'cache_time' => $cacheTime,
            'url' => $url
        ]);
    }

    /**
     * Отправляет ответ на встроеный запрос.
     *
     * @link https://core.telegram.org/bots/api#answerinlinequery
     *
     * @param string $inlineQueryId
     * @param InlineQueryResult[] $results
     * @param int|null $cacheTime
     * @param bool|null $isPersonal
     * @param string|null $nextOffset
     * @param string|null $switchPmText
     * @param string|null $switchPmParameter
     *
     * @return bool
     */
    public function answerInlineQuery(
        $inlineQueryId,
        $results,
        $cacheTime = null,
        $isPersonal = null,
        $nextOffset = null,
        $switchPmText = null,
        $switchPmParameter = null
    ) {
        return $this->call('answerInlineQuery', [
            'inline_query_id' => $inlineQueryId,
            'results' => Utils::toJson($results),
            'cache_time' => $cacheTime,
            'is_personal' => $isPersonal,
            'next_offset' => $nextOffset,
            'switch_pm_text' => $switchPmText,
            'switch_pm_parameter' => Utils::checkStr($switchPmParameter, 1, 64)
        ]);
    }

    /**
     * Отправляет ответ на запросы перед оформлением заказа.
     *
     * @link https://core.telegram.org/bots/api#answerprecheckoutquery
     *
     * @param string $preCheckoutQueryId
     * @param bool $ok
     * @param string|null $errorMessage
     *
     * @return bool
     */
    public function answerPreCheckoutQuery(
        $preCheckoutQueryId,
        $ok,
        $errorMessage = null
    ) {
        return $this->call('answerPreCheckoutQuery', [
            'pre_checkout_query_id' => $preCheckoutQueryId,
            'ok' => $ok,
            'error_message' => $errorMessage
        ]);
    }

    /**
     * Отправляет ответ на запросы о доставке.
     *
     * @link https://core.telegram.org/bots/api#answershippingquery
     *
     * @param string $shippingQueryId
     * @param bool $ok
     * @param ShippingOption[]|null $shippingOptions
     * @param string|null $errorMessage
     *
     * @return bool
     */
    public function answerShippingQuery(
        $shippingQueryId,
        $ok,
        $shippingOptions = null,
        $errorMessage = null
    ) {
        return $this->call('answerShippingQuery', [
            'shipping_query_id' => $shippingQueryId,
            'ok' => $ok,
            'shipping_options' => Utils::toJsonOrNull($shippingOptions),
            'error_message' => $errorMessage
        ]);
    }

    /* ------------------------ Игры ------------------------ */

    /**
     * Получает данные для таблиц рекордов.
     * Вернет счет указанного пользователя и нескольких его соседей в игре.
     *
     * @link https://core.telegram.org/bots/api#getgamehighscores
     *
     * @param int $userId
     * @param int|null $chatId
     * @param int|null $messageId
     * @param string|null $inlineMessageId
     *
     * @return GameHighScore[]
     */
    public function getGameHighScores(
        $userId,
        $chatId = null,
        $messageId = null,
        $inlineMessageId = null
    ) {
        return Utils::makeArray(GameHighScore::class, $this->call('getGameHighScores', [
            'user_id' => $userId,
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'inline_message_id' => ($chatId !== null || $messageId !== null) ? null : $inlineMessageId
        ]));
    }

    /**
     * Устанавливает счет указанного пользователя в игре.
     *
     * @link https://core.telegram.org/bots/api#setgamescore
     *
     * @param int $userId
     * @param int $score
     * @param bool|null $force
     * @param bool|null $disableEditMessage
     * @param int|null $chatId
     * @param int|null $messageId
     * @param string|null $inlineMessageId
     *
     * @return Message|bool
     */
    public function setGameScore(
        $userId,
        $score,
        $force = null,
        $disableEditMessage = null,
        $chatId = null,
        $messageId = null,
        $inlineMessageId = null
    ) {
        return $this->_message('setGameScore', [
            'user_id' => $userId,
            'score' => $score < 0 ? 0 : $score,
            'force' => $force,
            'disable_edit_message' => $disableEditMessage,
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'inline_message_id' => ($chatId !== null || $messageId !== null) ? null : $inlineMessageId
        ]);
    }

    /* ------------------------ Разное ------------------------ */

    /**
     * Получает основную информацию о боте.
     *
     * @link https://core.telegram.org/bots/api#getme
     *
     * @return User
     */
    public function getMe()
    {
        return new User($this->call('getMe'));
    }

    /**
     * Бот выходит с облачного сервера API бота перед локальным запуском бота.
     *
     * @link @https://core.telegram.org/bots/api#logout
     *
     * @return bool
     */
    public function logOut() 
    {
        return $this->call('logOut');
    }

    /**
     * Закрывает экземпляр бота перед перемещением его с одного локального сервера на другой.
     *
     * @link https://core.telegram.org/bots/api#close
     *
     * @return bool
     */
    public function close()
    {
        return $this->call('close');
    }

    /**
     * Получает список изображений профиля пользователя.
     *
     * @link https://core.telegram.org/bots/api#getuserprofilephotos
     *
     * @param int $userId
     * @param int|null $offset
     * @param int|null $limit
     *
     * @return UserProfilePhotos
     */
    public function getUserProfilePhotos(
        $userId,
        $offset = null,
        $limit = null
    ) {
        return new UserProfilePhotos($this->call('getUserProfilePhotos', [
           'user_id' => $userId,
           'offset' => $offset,
           'limit' => Utils::checkNum($limit, 1, 100)
        ]));
    }

    /**
     * Получает текущий список команд бота.
     *
     * @link https://core.telegram.org/bots/api#getmycommands
     *
     * @param BotCommandScope $scope
     * @param string $languageCode
     *
     * @return BotCommand[]
     */
    public function getMyCommands(
        $scope = null,
        $languageCode = null
    ) {
        return Utils::makeArray(BotCommand::class, $this->call('getMyCommands', [
            'scope' => Utils::toJsonOrNull($scope),
            'language_code' => $languageCode
        ]));
    }

    /**
     * Устанавливает список команд бота.
     *
     * @link https://core.telegram.org/bots/api#setmycommands
     *
     * @param BotCommand[]|string[][] $commands
     * @param BotCommandScope $scope
     * @param string $languageCode
     *
     * @return bool
     */
    public function setMyCommands(
        $commands,
        $scope = null,
        $languageCode = null
    ) {
        foreach ($commands as $k => $v) {
            if (is_array($v)) {
                $commands[$k] = BotCommand::make($v[0], $v[1]);
            }
        }

        return $this->call('setMyCommands', [
            'commands' => Utils::toJson($commands),
            'scope' => Utils::toJsonOrNull($scope),
            'language_code' => $languageCode
        ]);
    }

    /**
     * Удаляет список команд бота.
     *
     * @param BotCommandScope $scope
     * @param string $languageCode
     *
     * @return bool
     */
    public function deleteMyCommands(
        $scope = null,
        $languageCode = null
    ) {
        return $this->call('deleteMyCommands', [
            'scope' => Utils::toJsonOrNull($scope),
            'language_code' => $languageCode
        ]);
    }

    /**
     * Получает основную информацию о файле и подготовливает его к загрузке.
     *
     * @link https://core.telegram.org/bots/api#getfile
     *
     * @param string $fileId
     *
     * @return File
     */
    public function getFile(
        $fileId
    ) {
        return new File($this->call('getFile', [
            'file_id' => $fileId
        ]));
    }

    /**
     * (*) Получает ссылку на подготовленный файл.
     *
     * Ссылка НЕ предназначена для публичного доступа к файлу, т.к. в ней указан токен бота.
     *
     * @see getFile
     *
     * @param string $filePath
     *
     * @return string
     */
    public function getFileUrl(
        $filePath
    ) {
        return self::FILE_URL.$this->token.'/'.$filePath;
    }

    /**
     * Сообщает пользователю, что некоторые из предоставленных им элементов Telegram Passport содержат ошибки.
     *
     * @link https://core.telegram.org/bots/api#setpassportdataerrors
     *
     * @param int $userId
     * @param PassportElementError[] $errors
     *
     * @return bool
     */
    public function setPassportDataErrors(
        $userId,
        $errors
    ) {
        return $this->call('setPassportDataErrors', [
            'user_id,' => $userId,
            'errors' => Utils::toJson($errors)
        ]);
    }
}
