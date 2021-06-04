<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#chat
 *
 * @method                  int getId()
 * @method               string getType()
 * @method          string|null getTitle()
 * @method          string|null getUsername()
 * @method          string|null getFirstName()
 * @method          string|null getLastName()
 * @method       ChatPhoto|null getPhoto()
 * @method          string|null getBio()
 * @method          string|null getDescription()
 * @method          string|null getInviteLink()
 * @method         Message|null getPinnedMessage()
 * @method ChatPermissions|null getPermissions()
 * @method             int|null getSlowModeDelay()
 * @method             int|null getMessageAutoDeleteTime()
 * @method          string|null getStickerSetName()
 * @method            bool|null getCanSetStickerSet()
 * @method             int|null getLinkedChatId()
 * @method    ChatLocation|null getLocation()
 * @method            bool|null getAllMembersAreAdministrators()
 */
class Chat extends Entity
{
	const TYPE_PRIVATE = 'private';
	const TYPE_GROUP = 'group';
	const TYPE_SUPERGROUP = 'supergroup';
	const TYPE_CHANNEL = 'channel';

	const ACTION_TYPING = 'typing';
	const ACTION_UPLOAD_PHOTO = 'upload_photo';
	const ACTION_RECORD_VIDEO = 'record_video';
	const ACTION_UPLOAD_VIDEO = 'upload_video';
    /** @deprecated */
	const ACTION_RECORD_AUDIO = 'record_audio';
    /** @deprecated */
	const ACTION_UPLOAD_AUDIO = 'upload_audio';
    const ACTION_RECORD_VOICE = 'record_voice';
    const ACTION_UPLOAD_VOICE = 'upload_voice';
    const ACTION_UPLOAD_DOCUMENT = 'upload_document';
	const ACTION_FIND_LOCATION = 'find_location';
	const ACTION_RECORD_VIDEO_NOTE = 'record_video_note';
	const ACTION_UPLOAD_VIDEO_NOTE = 'upload_video_note';


    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'photo' => ChatPhoto::class,
            'pinned_message' => Message::class,
            'permissions' => ChatPermissions::class,
            'location' => ChatLocation::class
        ];
    }

    /**
     * @return bool
     */
    public function isPrivate()
    {
        return $this->getType() == self::TYPE_PRIVATE;
    }

    /**
     * @return bool
     */
    public function isGroup()
    {
        return $this->getType() == self::TYPE_GROUP;
    }

    /**
     * @return bool
     */
    public function isSupergroup()
    {
        return $this->getType() == self::TYPE_SUPERGROUP;
    }

    /**
     * @return bool
     */
    public function isChannel()
    {
        return $this->getType() == self::TYPE_CHANNEL;
    }
}
