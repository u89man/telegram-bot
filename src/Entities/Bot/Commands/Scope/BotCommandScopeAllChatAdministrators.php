<?php

namespace U89Man\TBot\Entities\Bot\Commands\Scope;

/**
 * @link https://core.telegram.org/bots/api#botcommandscopeallchatadministrators
 *
 * @method string getType()
 *
 * @method  $this setType(string $type)
 */
class BotCommandScopeAllChatAdministrators extends BotCommandScope
{
    /**
     * @return BotCommandScopeAllChatAdministrators
     */
    public static function make()
    {
        return new static([
            'type' => BotCommandScope::TYPE_ALL_CHAT_ADMINISTRATORS
        ]);
    }
}
