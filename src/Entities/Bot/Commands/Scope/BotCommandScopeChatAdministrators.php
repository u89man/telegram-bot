<?php

namespace U89Man\TBot\Entities\Bot\Commands\Scope;

/**
 * @link https://core.telegram.org/bots/api#botcommandscopechatadministrators
 *
 * @method     string getType()
 * @method int|string getChatId()
 *
 * @method      $this setType(string $type)
 * @method      $this setChatId(int|string $chatId)
 */
class BotCommandScopeChatAdministrators extends BotCommandScope
{
    /**
     * @param int|string $chatId
     *
     * @return BotCommandScopeChatAdministrators
     */
    public static function make(
        $chatId
    ) {
        return new static([
            'type' => BotCommandScope::TYPE_CHAT_ADMINISTRATORS,
            'chat_id' => $chatId
        ]);
    }
}
