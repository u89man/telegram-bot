<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#making-requests
 *
 * @method                    bool getOk()
 * @method              mixed|null getResult()
 * @method             string|null getDescription()
 * @method                int|null getErrorCode()
 * @method ResponseParameters|null getParameters()
 */
class Response extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'parameters' => ResponseParameters::class
        ];
    }
}
