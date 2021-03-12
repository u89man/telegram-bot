<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#chatinvitelink
 *
 * @method   string getInviteLink()
 * @method     User getCreator()
 * @method     bool getIsPrimary()
 * @method     bool getIsRevoked()
 * @method int|null getExpireDate()
 * @method int|null getMemberLimit()
 */
class ChatInviteLink extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'creator' => User::class
        ];
    }
}
