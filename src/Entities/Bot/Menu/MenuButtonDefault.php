<?php

namespace U89Man\TBot\Entities\Bot\Menu;

/**
 * @link https://core.telegram.org/bots/api#menubuttondefault
 */
class MenuButtonDefault extends MenuButton
{
    /**
     * @return $this
     */
    public static function make() {
        return new static([
            'type' => MenuButton::TYPE_DEFAULT
        ]);
    }
}
