<?php

namespace U89Man\TBot\Entities\Bot\Menu;

use U89Man\TBot\Entities\Keyboards\WebAppInfo;

/**
 * @link https://core.telegram.org/bots/api#menubuttonwebapp
 *
 * @method     string getText()
 * @method WebAppInfo getWebApp()
 *
 * @method      $this setText(string $text)
 * @method      $this setWebApp(WebAppInfo $webApp)
 */
class MenuButtonWebApp extends MenuButton
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'web_app' => WebAppInfo::class
        ];
    }

    /**
     * @param string $text
     * @param WebAppInfo $webApp
     *
     * @return $this
     */
    public static function make(
        $text,
        $webApp
    ) {
        return new static([
            'type' => MenuButton::TYPE_WEB_APP,
            'text' => $text,
            'web_app' => $webApp
        ]);
    }
}
