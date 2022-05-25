<?php

namespace U89Man\TBot\Entities;

use U89Man\TBot\Entities\Games\Game;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup;
use U89Man\TBot\Entities\Passport\PassportData;
use U89Man\TBot\Entities\Payments\Invoice;
use U89Man\TBot\Entities\Payments\SuccessfulPayment;
use U89Man\TBot\Entities\Poll\Poll;
use U89Man\TBot\Entities\Stickers\Sticker;

/**
 * @link https://core.telegram.org/bots/api#message
 *
 * @method                                int getMessageId()
 * @method                          User|null getFrom()
 * @method                                int getDate()
 * @method                               Chat getChat()
 * @method                          Chat|null getSenderChat()
 * @method                          User|null getForwardFrom()
 * @method                          Chat|null getForwardFromChat()
 * @method                           int|null getForwardFromMessageId()
 * @method                        string|null getForwardSignature()
 * @method                        string|null getForwardSenderName()
 * @method                           int|null getForwardDate()
 * @method                       Message|null getReplyToMessage()
 * @method                          User|null getViaBot()
 * @method                           int|null getEditDate()
 * @method                          bool|null getHasProtectedContent()
 * @method                        string|null getMediaGroupId()
 * @method                        string|null getAuthorSignature()
 * @method                        string|null getText()
 * @method               MessageEntity[]|null getEntities()
 * @method                         Audio|null getAudio()
 * @method                      Document|null getDocument()
 * @method                     Animation|null getAnimation()
 * @method                          Game|null getGame()
 * @method                   PhotoSize[]|null getPhoto()
 * @method                       Sticker|null getSticker()
 * @method                         Video|null getVideo()
 * @method                         Voice|null getVoice()
 * @method                     VideoNote|null getVideoNote()
 * @method                        string|null getCaption()
 * @method               MessageEntity[]|null getCaptionEntities()
 * @method                       Contact|null getContact()
 * @method                      Location|null getLocation()
 * @method                         Venue|null getVenue()
 * @method                          Poll|null getPoll()
 * @method                          Dice|null getDice()
 * @method                        User[]|null getNewChatMembers()
 * @method                          User|null getLeftChatMember()
 * @method                        string|null getNewChatTitle()
 * @method                   PhotoSize[]|null getNewChatPhoto()
 * @method                          bool|null getDeleteChatPhoto()
 * @method                          bool|null getGroupChatCreated()
 * @method                          bool|null getSupergroupChatCreated()
 * @method                          bool|null getChannelChatCreated()
 * @method MessageAutoDeleteTimerChanged|null getMessageAutoDeleteTimerChanged()
 * @method                           int|null getMigrateToChatId()
 * @method                           int|null getMigrateFromChatId()
 * @method                       Message|null getPinnedMessage()
 * @method                       Invoice|null getInvoice()
 * @method             SuccessfulPayment|null getSuccessfulPayment()
 * @method                        string|null getConnectedWebsite()
 * @method                  PassportData|null getPassportData()
 * @method       ProximityAlertTriggered|null getProximityAlertTriggered()
 * @method            VoiceChatScheduled|null getVoiceChatScheduled()
 * @method              VoiceChatStarted|null getVoiceChatStarted()
 * @method                VoiceChatEnded|null getVoiceChatEnded()
 * @method  VoiceChatParticipantsInvited|null getVoiceChatParticipantsInvited()
 * @method          InlineKeyboardMarkup|null getReplyMarkup()
 */
class Message extends Entity
{
    const TYPE_TEXT = 'text';
	const TYPE_AUDIO = 'audio';
	const TYPE_DOCUMENT = 'document';
	const TYPE_ANIMATION = 'animation';
	const TYPE_GAME = 'game';
	const TYPE_PHOTO = 'photo';
	const TYPE_STICKER = 'sticker';
	const TYPE_VIDEO = 'video';
	const TYPE_VOICE = 'voice';
	const TYPE_VIDEO_NOTE = 'video_note';
	const TYPE_CONTACT = 'contact';
	const TYPE_LOCATION = 'location';
	const TYPE_VENUE = 'venue';
	const TYPE_POLL = 'poll';
	const TYPE_DICE = 'dice';
	const TYPE_NEW_CHAT_MEMBERS = 'new_chat_members';
	const TYPE_LEFT_CHAT_MEMBER = 'left_chat_member';
	const TYPE_NEW_CHAT_TITLE = 'new_chat_title';
	const TYPE_NEW_CHAT_PHOTO = 'new_chat_photo';
	const TYPE_DELETE_CHAT_PHOTO = 'delete_chat_photo';
	const TYPE_GROUP_CHAT_CREATED = 'group_chat_created';
	const TYPE_MESSAGE_AUTO_DELETE_TIMER_CHANGED = 'message_auto_delete_timer_changed';
	const TYPE_SUPERGROUP_CHAT_CREATED = 'supergroup_chat_created';
	const TYPE_CHANNEL_CHAT_CREATED = 'channel_chat_created';
	const TYPE_MIGRATE_TO_CHAT_ID = 'migrate_to_chat_id';
	const TYPE_MIGRATE_FROM_CHAT_ID = 'migrate_from_chat_id';
	const TYPE_PINNED_MESSAGE = 'pinned_message';
	const TYPE_INVOICE = 'invoice';
	const TYPE_SUCCESSFUL_PAYMENT = 'successful_payment';
    const TYPE_PROXIMITY_ALERT_TRIGGERED = 'proximity_alert_triggered';
    const TYPE_VOICE_CHAT_SCHEDULED = 'voice_chat_scheduled';
    const TYPE_VOICE_CHAT_STARTED = 'voice_chat_started';
    const TYPE_VOICE_CHAT_ENDED = 'voice_chat_ended';
    const TYPE_VOICE_CHAT_PARTICIPANTS_INVITED = 'voice_chat_participants_invited';
	const TYPE_UNKNOWN = 'unknown';


    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'from' => User::class,
            'chat' => Chat::class,
            'sender_chat' => Chat::class,
            'forward_from' => User::class,
            'forward_from_chat' => Chat::class,
            'reply_to_message' => Message::class,
            'via_bot' => User::class,
            'entities' => [MessageEntity::class],
            'audio' => Audio::class,
            'document' => Document::class,
            'animation' => Animation::class,
            'game' => Game::class,
            'photo' => [PhotoSize::class],
            'sticker' => Sticker::class,
            'video' => Video::class,
            'voice' => Voice::class,
            'video_note' => VideoNote::class,
            'caption_entities' => [MessageEntity::class],
            'contact' => Contact::class,
            'location' => Location::class,
            'venue' => Venue::class,
            'poll' => Poll::class,
            'dice' => Dice::class,
            'new_chat_members' => [User::class],
            'left_chat_member' => User::class,
            'new_chat_photo' => [PhotoSize::class],
            'message_auto_delete_timer_changed' => MessageAutoDeleteTimerChanged::class,
            'pinned_message' => Message::class,
            'invoice' => Invoice::class,
            'successful_payment' => SuccessfulPayment::class,
            'passport_data' => PassportData::class,
            'proximity_alert_triggered' => ProximityAlertTriggered::class,
            'voice_chat_scheduled' => VoiceChatScheduled::class,
            'voice_chat_started' => VoiceChatStarted::class,
            'voice_chat_ended' => VoiceChatEnded::class,
            'voice_chat_participants_invited' => VoiceChatParticipantsInvited::class,
            'reply_markup' => InlineKeyboardMarkup::class
        ];
    }

	/**
	 * @return string
	 */
	public function getType()
    {
		$types = [
            Message::TYPE_TEXT,
            Message::TYPE_AUDIO,
            Message::TYPE_ANIMATION,
            Message::TYPE_DOCUMENT,
            Message::TYPE_GAME ,
            Message::TYPE_PHOTO,
            Message::TYPE_STICKER,
            Message::TYPE_VIDEO,
            Message::TYPE_VOICE,
            Message::TYPE_VIDEO_NOTE,
            Message::TYPE_CONTACT,
            Message::TYPE_VENUE,
            Message::TYPE_LOCATION,
            Message::TYPE_POLL,
            Message::TYPE_DICE,
            Message::TYPE_NEW_CHAT_MEMBERS,
            Message::TYPE_LEFT_CHAT_MEMBER,
            Message::TYPE_NEW_CHAT_TITLE,
            Message::TYPE_NEW_CHAT_PHOTO,
            Message::TYPE_DELETE_CHAT_PHOTO,
            Message::TYPE_GROUP_CHAT_CREATED,
            Message::TYPE_SUPERGROUP_CHAT_CREATED,
            Message::TYPE_CHANNEL_CHAT_CREATED,
            Message::TYPE_MESSAGE_AUTO_DELETE_TIMER_CHANGED,
            Message::TYPE_MIGRATE_TO_CHAT_ID,
            Message::TYPE_MIGRATE_FROM_CHAT_ID,
            Message::TYPE_PINNED_MESSAGE,
            Message::TYPE_INVOICE,
            Message::TYPE_SUCCESSFUL_PAYMENT,
            Message::TYPE_PROXIMITY_ALERT_TRIGGERED,
            Message::TYPE_VOICE_CHAT_SCHEDULED,
            Message::TYPE_VOICE_CHAT_STARTED,
            Message::TYPE_VOICE_CHAT_ENDED,
            Message::TYPE_VOICE_CHAT_PARTICIPANTS_INVITED
		];

		foreach ($types as $type) {
			if ($this->has($type)) return $type;
		}

		return Message::TYPE_UNKNOWN;
	}

    /**
     * @return string|null
     */
    public function getFirstBotCommand()
    {
        $fromCaption = false;
        $entities = $this->getEntities();

        if ($entities == null) {
            $entities = $this->getCaptionEntities();
            $fromCaption = true;

            if ($entities == null) {
                return null;
            }
        }

        foreach ($entities as $entity) {
            if ($entity->isBotCommand()) {
                $string = $fromCaption ? $this->getCaption() : $this->getText();
                return mb_substr($string, $entity->getOffset(), $entity->getLength());
            }
        }

        return null;
    }

    /**
     * @return bool
     */
    public function isText()
    {
        return $this->getType() == Message::TYPE_TEXT;
    }

    /**
     * @return bool
     */
    public function isAudio()
    {
        return $this->getType() == Message::TYPE_AUDIO;
    }

    /**
     * @return bool
     */
    public function isDocument()
    {
        return $this->getType() == Message::TYPE_DOCUMENT;
    }

    /**
     * @return bool
     */
    public function isAnimation()
    {
        return $this->getType() == Message::TYPE_ANIMATION;
    }

    /**
     * @return bool
     */
    public function isGame()
    {
        return $this->getType() == Message::TYPE_GAME;
    }

    /**
     * @return bool
     */
    public function isPhoto()
    {
        return $this->getType() == Message::TYPE_PHOTO;
    }

    /**
     * @return bool
     */
    public function isSticker()
    {
        return $this->getType() == Message::TYPE_STICKER;
    }

    /**
     * @return bool
     */
    public function isVideo()
    {
        return $this->getType() == Message::TYPE_VIDEO;
    }

    /**
     * @return bool
     */
    public function isVoice()
    {
        return $this->getType() == Message::TYPE_VOICE;
    }

    /**
     * @return bool
     */
    public function isVideoNote()
    {
        return $this->getType() == Message::TYPE_VIDEO_NOTE;
    }

    /**
     * @return bool
     */
    public function isContact()
    {
        return $this->getType() == Message::TYPE_CONTACT;
    }

    /**
     * @return bool
     */
    public function isLocation()
    {
        return $this->getType() == Message::TYPE_LOCATION;
    }

    /**
     * @return bool
     */
    public function isVenue()
    {
        return $this->getType() == Message::TYPE_VENUE;
    }

    /**
     * @return bool
     */
    public function isPoll()
    {
        return $this->getType() == Message::TYPE_POLL;
    }

    /**
     * @return bool
     */
    public function isDice()
    {
        return $this->getType() == Message::TYPE_DICE;
    }

    /**
     * @return bool
     */
    public function isNewChatMembers()
    {
        return $this->getType() == Message::TYPE_NEW_CHAT_MEMBERS;
    }

    /**
     * @return bool
     */
    public function isLeftChatMember()
    {
        return $this->getType() == Message::TYPE_LEFT_CHAT_MEMBER;
    }

    /**
     * @return bool
     */
    public function isNewChatTitle()
    {
        return $this->getType() == Message::TYPE_NEW_CHAT_TITLE;
    }

    /**
     * @return bool
     */
    public function isnNewChatPhoto()
    {
        return $this->getType() == Message::TYPE_NEW_CHAT_PHOTO;
    }

    /**
     * @return bool
     */
    public function isDeleteChatPhoto()
    {
        return $this->getType() == Message::TYPE_DELETE_CHAT_PHOTO;
    }

    /**
     * @return bool
     */
    public function isGroupChatCreated()
    {
        return $this->getType() == Message::TYPE_GROUP_CHAT_CREATED;
    }

    /**
     * @return bool
     */
    public function isSupergroupChatCreated()
    {
        return $this->getType() == Message::TYPE_SUPERGROUP_CHAT_CREATED;
    }

    /**
     * @return bool
     */
    public function isChannelChatCreated()
    {
        return $this->getType() == Message::TYPE_CHANNEL_CHAT_CREATED;
    }

    /**
     * @return bool
     */
    public function isMessageAutoDeleteTimerChanged()
    {
        return $this->getType() == Message::TYPE_MESSAGE_AUTO_DELETE_TIMER_CHANGED;
    }

    /**
     * @return bool
     */
    public function isMigrateToChatId()
    {
        return $this->getType() == Message::TYPE_MIGRATE_TO_CHAT_ID;
    }

    /**
     * @return bool
     */
    public function isMigrateFromChatId()
    {
        return $this->getType() == Message::TYPE_MIGRATE_FROM_CHAT_ID;
    }

    /**
     * @return bool
     */
    public function isPinnedMessage()
    {
        return $this->getType() == Message::TYPE_PINNED_MESSAGE;
    }

    /**
     * @return bool
     */
    public function isInvoice()
    {
        return $this->getType() == Message::TYPE_INVOICE;
    }

    /**
     * @return bool
     */
    public function isSuccessfulPayment()
    {
        return $this->getType() == Message::TYPE_SUCCESSFUL_PAYMENT;
    }

    /**
     * @return bool
     */
    public function isProximityAlertTriggered()
    {
        return $this->getType() == Message::TYPE_PROXIMITY_ALERT_TRIGGERED;
    }

    /**
     * @return bool
     */
    public function isVoiceChatScheduled()
    {
        return $this->getType() == Message::TYPE_VOICE_CHAT_SCHEDULED;
    }

    /**
     * @return bool
     */
    public function isVoiceChatStarted()
    {
        return $this->getType() == Message::TYPE_VOICE_CHAT_STARTED;
    }

    /**
     * @return bool
     */
    public function isVoiceChatEnded()
    {
        return $this->getType() == Message::TYPE_VOICE_CHAT_ENDED;
    }

    /**
     * @return bool
     */
    public function isVoiceChatParticipantsInvited()
    {
        return $this->getType() == Message::TYPE_VOICE_CHAT_PARTICIPANTS_INVITED;
    }
}
