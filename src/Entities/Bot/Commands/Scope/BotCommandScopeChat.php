<?php

namespace U89Man\TBot\Entities\Bot\Commands\Scope;

/**
 * @link https://core.telegram.org/bots/api#botcommandscopechat
 *
 * @method     string getType()
 * @method int|string getChatId()
 *
 * @method      $this setType(string $type)
 * @method      $this setChatId(int|string $chatId)
 */
class BotCommandScopeChat extends BotCommandScope
{
    /**
     * @param int|string $chatId
     *
     * @return BotCommandScopeChat
     */
    public static function make(
        $chatId
    ) {
        return new static([
            'type' => BotCommandScope::TYPE_CHAT,
            'chat_id' => $chatId
        ]);
    }
}
