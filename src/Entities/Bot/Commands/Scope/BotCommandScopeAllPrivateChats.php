<?php

namespace U89Man\TBot\Entities\Bot\Commands\Scope;

/**
 * @link https://core.telegram.org/bots/api#botcommandscopeallprivatechats
 *
 * @method string getType()
 *
 * @method  $this setType(string $type)
 */
class BotCommandScopeAllPrivateChats extends BotCommandScope
{
    /**
     * @return BotCommandScopeAllPrivateChats
     */
    public static function make()
    {
        return new static([
            'type' => BotCommandScope::TYPE_ALL_PRIVATE_CHATS
        ]);
    }
}
