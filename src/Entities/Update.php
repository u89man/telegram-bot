<?php

namespace U89Man\TBot\Entities;

use U89Man\TBot\Entities\Inline\ChosenInlineResult;
use U89Man\TBot\Entities\Inline\InlineQuery;
use U89Man\TBot\Entities\Passport\PassportData;
use U89Man\TBot\Entities\Payments\PreCheckoutQuery;
use U89Man\TBot\Entities\Payments\ShippingQuery;
use U89Man\TBot\Entities\Poll\Poll;
use U89Man\TBot\Entities\Poll\PollAnswer;

/**
 * @link https://core.telegram.org/bots/api#update
 *
 * @method                     int getUpdateId()
 * @method            Message|null getMessage()
 * @method            Message|null getEditedMessage()
 * @method            Message|null getChannelPost()
 * @method            Message|null getEditedChannelPost()
 * @method        InlineQuery|null getInlineQuery()
 * @method ChosenInlineResult|null getChosenInlineResult()
 * @method      CallbackQuery|null getCallbackQuery()
 * @method      ShippingQuery|null getShippingQuery()
 * @method   PreCheckoutQuery|null getPreCheckoutQuery()
 * @method       PassportData|null getPassportData()
 * @method               Poll|null getPoll()
 * @method         PollAnswer|null getPollAnswer()
 * @method  ChatMemberUpdated|null getMyChatMember()
 * @method  ChatMemberUpdated|null getChatMember()
 * @method    ChatJoinRequest|null getChatJoinRequest()
 */
class Update extends Entity
{
	const TYPE_ALL = '';

	const TYPE_MESSAGE = 'message';
	const TYPE_EDITED_MESSAGE = 'edited_message';
	const TYPE_CHANNEL_POST = 'channel_post';
	const TYPE_EDITED_CHANNEL_POST = 'edited_channel_post';
	const TYPE_INLINE_QUERY = 'inline_query';
	const TYPE_CHOSEN_INLINE_RESULT = 'chosen_inline_result';
	const TYPE_CALLBACK_QUERY = 'callback_query';
	const TYPE_SHIPPING_QUERY = 'shipping_query';
	const TYPE_PRE_CHECKOUT_QUERY = 'pre_checkout_query';
    const TYPE_PASSPORT_DATA = 'passport_data';
	const TYPE_POLL = 'poll';
	const TYPE_POLL_ANSWER = 'poll_answer';
	const TYPE_MY_CHAT_MEMBER = 'my_chat_member';
	const TYPE_CHAT_MEMBER = 'chat_member';
	const TYPE_CHAT_JOIN_REQUEST = 'chat_join_request';


    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'message' => Message::class,
            'edited_message' => Message::class,
            'channel_post' => Message::class,
            'edited_channel_post' => Message::class,
            'inline_query' => InlineQuery::class,
            'chosen_inline_result' => ChosenInlineResult::class,
            'callback_query' => CallbackQuery::class,
            'shipping_query' => ShippingQuery::class,
            'pre_checkout_query' => PreCheckoutQuery::class,
            'passport_data' => PassportData::class,
            'poll' => Poll::class,
            'poll_answer' => PollAnswer::class,
            'my_chat_member' => ChatMemberUpdated::class,
            'chat_member' => ChatMemberUpdated::class,
            'chat_join_request' => ChatJoinRequest::class
        ];
    }

	/**
	 * @return string|null
	 */
	public function getType()
    {
		$types = [
            Update::TYPE_MESSAGE,
            Update::TYPE_EDITED_MESSAGE,
            Update::TYPE_CHANNEL_POST,
            Update::TYPE_EDITED_CHANNEL_POST,
            Update::TYPE_INLINE_QUERY,
            Update::TYPE_CHOSEN_INLINE_RESULT,
            Update::TYPE_CALLBACK_QUERY,
            Update::TYPE_SHIPPING_QUERY,
            Update::TYPE_PRE_CHECKOUT_QUERY,
            Update::TYPE_PASSPORT_DATA,
            Update::TYPE_POLL,
            Update::TYPE_POLL_ANSWER,
            Update::TYPE_MY_CHAT_MEMBER,
            Update::TYPE_CHAT_MEMBER,
            Update::TYPE_CHAT_JOIN_REQUEST
		];

		foreach ($types as $type) {
			if ($this->has($type)) return $type;
		}

		return null;
	}

    /**
     * @return bool
     */
    public function isMessage()
    {
        return $this->getType() == Update::TYPE_MESSAGE;
    }

    /**
     * @return bool
     */
    public function isEditedMessage()
    {
        return $this->getType() == Update::TYPE_EDITED_MESSAGE;
    }

    /**
     * @return bool
     */
    public function isChannelPost()
    {
        return $this->getType() == Update::TYPE_CHANNEL_POST;
    }

    /**
     * @return bool
     */
    public function isEditedChannelPost()
    {
        return $this->getType() == Update::TYPE_EDITED_CHANNEL_POST;
    }

    /**
     * @return bool
     */
    public function isInlineQuery()
    {
        return $this->getType() == Update::TYPE_INLINE_QUERY;
    }

    /**
     * @return bool
     */
    public function isChosenInlineResult()
    {
        return $this->getType() == Update::TYPE_CHOSEN_INLINE_RESULT;
    }

    /**
     * @return bool
     */
    public function isCallbackQuery()
    {
        return $this->getType() == Update::TYPE_CALLBACK_QUERY;
    }

    /**
     * @return bool
     */
    public function isShippingQuery()
    {
        return $this->getType() == Update::TYPE_SHIPPING_QUERY;
    }

    /**
     * @return bool
     */
    public function isPreCheckoutQuery()
    {
        return $this->getType() == Update::TYPE_PRE_CHECKOUT_QUERY;
    }

    /**
     * @return bool
     */
    public function isPassportData()
    {
        return $this->getType() == Update::TYPE_PASSPORT_DATA;
    }

    /**
     * @return bool
     */
    public function isPoll()
    {
        return $this->getType() == Update::TYPE_POLL;
    }

    /**
     * @return bool
     */
    public function isPollAnswer()
    {
        return $this->getType() == Update::TYPE_POLL_ANSWER;
    }

    /**
     * @return bool
     */
    public function isMyChatMember()
    {
        return $this->getType() == Update::TYPE_MY_CHAT_MEMBER;
    }

    /**
     * @return bool
     */
    public function isChatMember()
    {
        return $this->getType() == Update::TYPE_CHAT_MEMBER;
    }

    /**
     * @return bool
     */
    public function isChatJoinRequest()
    {
        return $this->getType() == Update::TYPE_CHAT_JOIN_REQUEST;
    }
}
