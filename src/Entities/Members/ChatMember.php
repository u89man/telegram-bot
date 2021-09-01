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
     * @return bool
     */
    public function isCreator()
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
     * @return bool
     */
    public function isKicked()
    {
        return $this->getStatus() == ChatMember::STATUS_KICKED;
    }
}
