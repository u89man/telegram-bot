<?php

namespace U89Man\TBot\Entities;

use U89Man\TBot\Entities\Members\ChatMember;
use U89Man\TBot\Entities\Members\ChatMemberAdministrator;
use U89Man\TBot\Entities\Members\ChatMemberBanned;
use U89Man\TBot\Entities\Members\ChatMemberLeft;
use U89Man\TBot\Entities\Members\ChatMemberMember;
use U89Man\TBot\Entities\Members\ChatMemberOwner;
use U89Man\TBot\Entities\Members\ChatMemberRestricted;

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
        return $this->getConcreteChatMember($this->get('old_chat_member'));
    }

    /**
     * @return ChatMember
     */
    public function getNewChatMember()
    {
        return $this->getConcreteChatMember($this->get('new_chat_member'));
    }

    /**
     * @param array $data
     *
     * @return ChatMember
     */
    protected function getConcreteChatMember($data)
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
}
