<?php

namespace U89Man\TBot\Entities\Keyboards;

/**
 * @link https://core.telegram.org/bots/api#webappinfo
 *
 * @method string getUrl()
 *
 * @method  $this setUrl(string $url)
 */
class WebAppInfo extends Keyboard
{
    /**
     * @param string $url
     *
     * @return $this
     */
    public static function make($url)
    {
        return new static([
            'url' => $url
        ]);
    }
}
