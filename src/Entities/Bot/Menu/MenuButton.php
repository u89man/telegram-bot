<?php

namespace U89Man\TBot\Entities\Bot\Menu;

use U89Man\TBot\Entities\Bot\BotEntity;

/**
 * @link https://core.telegram.org/bots/api#menubutton
 *
 * @method string getType()
 *
 * @method  $this setType(string $type)
 */
abstract class MenuButton extends BotEntity
{
    const TYPE_COMMANDS = 'commands';
    const TYPE_WEB_APP = 'web_app';
    const TYPE_DEFAULT = 'default';
}
