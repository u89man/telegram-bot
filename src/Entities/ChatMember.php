<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#chatmember
 *
 * @method        User getUser()
 * @method      string getStatus()
 * @method string|null getCustomTitle()
 * @method   bool|null getIsAnonymous()
 * @method    int|null getUntilDate()
 * @method   bool|null getCanBeEdited()
 * @method   bool|null getCanPostMessages()
 * @method   bool|null getCanEditMessages()
 * @method   bool|null getCanDeleteMessages()
 * @method   bool|null getCanManageVoiceChats()
 * @method   bool|null getCanRestrictMembers()
 * @method   bool|null getCanPromoteMembers()
 * @method   bool|null getCanChangeInfo()
 * @method   bool|null getCanInviteUsers()
 * @method   bool|null getCanPinMessages()
 * @method   bool|null getIsMember()
 * @method   bool|null getCanSendMessages()
 * @method   bool|null getCanSendMediaMessages()
 * @method   bool|null getCanSendPolls()
 * @method   bool|null getCanSendOtherMessages()
 * @method   bool|null getCanAddWebPagePreviews()
 */
class ChatMember extends Entity
{
	const STATUS_CREATOR = 'creator';
	const STATUS_ADMINISTRATOR = 'administrator';
	const STATUS_MEMBER = 'member';
	const STATUS_RESTRICTED = 'restricted';
	const STATUS_LEFT = 'left';
	const STATUS_KICKED = 'kicked';


    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'user' => User::class
        ];
    }

    /**
     * @return bool
     */
    public function isCreator()
    {
        return $this->getStatus() == self::STATUS_CREATOR;
    }

    /**
     * @return bool
     */
    public function isAdministrator()
    {
        return $this->getStatus() == self::STATUS_ADMINISTRATOR;
    }

    /**
     * @return bool
     */
    public function isMember()
    {
        return $this->getStatus() == self::STATUS_MEMBER;
    }

    /**
     * @return bool
     */
    public function isRestricted()
    {
        return $this->getStatus() == self::STATUS_RESTRICTED;
    }

    /**
     * @return bool
     */
    public function isLeft()
    {
        return $this->getStatus() == self::STATUS_LEFT;
    }

    /**
     * @return bool
     */
    public function isKicked()
    {
        return $this->getStatus() == self::STATUS_KICKED;
    }
}
