<?php

namespace U89Man\TBot\Entities\Bot\Menu;

/**
 * @link https://core.telegram.org/bots/api#menubuttoncommands
 */
class MenuButtonCommands extends MenuButton
{
    /**
     * @return $this
     */
    public static function make() {
        return new static([
            'type' => MenuButton::TYPE_COMMANDS
        ]);
    }
}
