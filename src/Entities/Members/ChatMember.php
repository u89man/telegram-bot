<?php

namespace U89Man\TBot\Entities\Members;

use U89Man\TBot\Entities\Entity;
use U89Man\TBot\Entities\User;

/**
 * @link https://core.telegram.org/bots/api#chatmember
 *
 * @method string getStatus()
 * @method   User getUser()
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
     * @param array $data
     *
     * @return ChatMember
     */
    public static function getConcreteEntity($data)
    {
        switch ($data['status']) {
            case ChatMember::STATUS_CREATOR:
                return new ChatMemberOwner($data);
            case ChatMember::STATUS_ADMINISTRATOR:
                return new ChatMemberAdministrator($data);
            case ChatMember::STATUS_MEMBER:
                return new ChatMemberMember($data);
            case ChatMember::STATUS_RESTRICTED:
                return new ChatMemberRestricted($data);
            case ChatMember::STATUS_LEFT:
                return new ChatMemberLeft($data);
            case ChatMember::STATUS_KICKED:
                return new ChatMemberBanned($data);
            default:
                return new ChatMember($data);
        }
    }

    /**
     * @deprecated
     *
     * @return bool
     */
    public function isCreator()
    {
        return $this->getStatus() == ChatMember::STATUS_CREATOR;
    }

    /**
     * @return bool
     */
    public function isOwner()
    {
        return $this->getStatus() == ChatMember::STATUS_CREATOR;
    }

    /**
     * @return bool
     */
    public function isAdministrator()
    {
        return $this->getStatus() == ChatMember::STATUS_ADMINISTRATOR;
    }

    /**
     * @return bool
     */
    public function isMember()
    {
        return $this->getStatus() == ChatMember::STATUS_MEMBER;
    }

    /**
     * @return bool
     */
    public function isRestricted()
    {
        return $this->getStatus() == ChatMember::STATUS_RESTRICTED;
    }

    /**
     * @return bool
     */
    public function isLeft()
    {
        return $this->getStatus() == ChatMember::STATUS_LEFT;
    }

    /**
     * @deprecated
     *
     * @return bool
     */
    public function isKicked()
    {
        return $this->getStatus() == ChatMember::STATUS_KICKED;
    }

    /**
     * @return bool
     */
    public function isBanned()
    {
        return $this->getStatus() == ChatMember::STATUS_KICKED;
    }
}
