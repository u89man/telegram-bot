<?php

namespace U89Man\TBot\Entities\Bot\Commands\Scope;

use U89Man\TBot\Entities\Bot\BotEntity;

/**
 * @link https://core.telegram.org/bots/api#botcommandscope
 */
abstract class BotCommandScope extends BotEntity
{
    const TYPE_DEFAULT = 'default';
    const TYPE_ALL_PRIVATE_CHATS = 'all_private_chats';
    const TYPE_ALL_GROUP_CHATS = 'all_group_chats';
    const TYPE_ALL_CHAT_ADMINISTRATORS = 'all_chat_administrators';
    const TYPE_CHAT = 'chat';
    const TYPE_CHAT_ADMINISTRATORS = 'chat_administrators';
    const TYPE_CHAT_MEMBER = 'chat_member';
}
