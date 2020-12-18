<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#callbackquery
 *
 * @method       string getId()
 * @method         User getFrom()
 * @method Message|null getMessage()
 * @method  string|null getInlineMessageId()
 * @method       string getChatInstance()
 * @method  string|null getData()
 * @method  string|null getGameShortName()
 */
class CallbackQuery extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'from' => User::class,
            'message' => Message::class
        ];
    }
}
