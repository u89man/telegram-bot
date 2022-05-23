<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#chatinvitelink
 *
 * @method      string getInviteLink()
 * @method        User getCreator()
 * @method        bool getCreatesJoinRequest()
 * @method        bool getIsPrimary()
 * @method        bool getIsRevoked()
 * @method string|null getName()
 * @method    int|null getExpireDate()
 * @method    int|null getMemberLimit()
 * @method    int|null getPendingJoinRequestCount()
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
