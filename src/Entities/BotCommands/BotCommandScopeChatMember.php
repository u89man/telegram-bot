<?php

namespace U89Man\TBot\Entities\BotCommands;

/**
 * @link https://core.telegram.org/bots/api#botcommandscopechatmember
 *
 * @method     string getType()
 * @method int|string getChatId()
 * @method        int getUserId()
 *
 * @method      $this setType(string $type)
 * @method      $this setChatId(int|string $chatId)
 * @method      $this setUserId(int $userId)
 */
class BotCommandScopeChatMember extends BotCommandScope
{
    /**
     * @param int|string $chatId
     * @param int $userId
     *
     * @return BotCommandScopeChatMember
     */
    public static function make(
        $chatId,
        $userId
    ) {
        return new static([
            'type' => BotCommandScope::TYPE_CHAT_MEMBER,
            'chat_id' => $chatId,
            'user_id' => $userId
        ]);
    }
}
