<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#voicechatparticipantsinvited
 *
 * @method User[]|null getUsers()
 */
class VoiceChatParticipantsInvited extends Entity
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'users' => [User::class]
        ];
    }
}
