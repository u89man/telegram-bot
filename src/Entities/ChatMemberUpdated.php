<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#chatmemberupdated
 *
 * @method                Chat getChat()
 * @method                User getFrom()
 * @method                 int getDate()
 * @method          ChatMember getOldChatMember()
 * @method          ChatMember getNewChatMember()
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
            'old_chat_member' => ChatMember::class,
            'new_chat_member' => ChatMember::class,
            'invite_link' => ChatInviteLink::class
        ];
    }
}
