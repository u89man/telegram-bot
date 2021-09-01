<?php

namespace U89Man\TBot\Entities;

use U89Man\TBot\Entities\Members\ChatMember;

/**
 * @link https://core.telegram.org/bots/api#chatmemberupdated
 *
 * @method                Chat getChat()
 * @method                User getFrom()
 * @method                 int getDate()
 * @method ChatInviteLink|null getInviteLink()
 */
class ChatMemberUpdated extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'chat' => Chat::class,
            'from' => User::class,
            'invite_link' => ChatInviteLink::class
        ];
    }

    /**
     * @return ChatMember
     */
    public function getOldChatMember()
    {
        return ChatMember::getConcreteEntity($this->get('old_chat_member'));
    }

    /**
     * @return ChatMember
     */
    public function getNewChatMember()
    {
        return ChatMember::getConcreteEntity($this->get('new_chat_member'));
    }
}
