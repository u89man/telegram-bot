<?php

namespace U89Man\TBot\Entities\Keyboards;

use U89Man\TBot\Entities\Entity;

/**
 * @link https://core.telegram.org/bots/api#webappinfo
 *
 * @method string getUrl()
 */
class WebAppInfo extends Entity
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
