<?php

namespace U89Man\TBot\Entities;

use CURLFile;

/**
 * @link https://core.telegram.org/bots/api#inputfile
 */
class InputFile extends CURLFile
{
    /**
     * @param string $filename
     * @param string $mimetype
     * @param string $postname
     *
     * @return $this
     */
    public static function make(
        $filename,
        $mimetype = '',
        $postname = ''
    ) {
	    return new static($filename, $mimetype, $postname);
	}
}
