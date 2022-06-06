<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#chatadministratorrights
 *
 * @method      bool getIsAnonymous()
 * @method      bool getCanManageChat()
 * @method      bool getCanDeleteMessages()
 * @method      bool getCanManageVideoChats()
 * @method      bool getCanRestrictMembers()
 * @method      bool getCanPromoteMembers()
 * @method      bool getCanChangeInfo()
 * @method      bool getCanInviteUsers()
 * @method bool|null getCanPostMessages()
 * @method bool|null getCanEditMessages()
 * @method bool|null getCanPinMessages()
 *
 * @method     $this setIsAnonymous(bool $isAnonymous)
 * @method     $this setCanManageChat(bool $canManageChat)
 * @method     $this setCanDeleteMessages(bool $canDeleteMessages)
 * @method     $this setCanManageVideoChats(bool $canManageVideoChats)
 * @method     $this setCanRestrictMembers(bool $canRestrictMembers)
 * @method     $this setCanPromoteMembers(bool $canPromoteMembers)
 * @method     $this setCanChangeInfo(bool $canChangeInfo)
 * @method     $this setCanInviteUsers(bool $canInviteUsers)
 * @method     $this setCanPostMessages(bool $canPostMessages)
 * @method     $this setCanEditMessages(bool $canEditMessages)
 * @method     $this setCanPinMessages(bool $canPinMessages)
 */
class ChatAdministratorRights extends Entity
{
    /**
     * @param bool $sAnonymous
     * @param bool $canManageChat
     * @param bool $canDeleteMessages
     * @param bool $canManageVideoChats
     * @param bool $canRestrictMembers
     * @param bool $canPromoteMembers
     * @param bool $canChangeInfo
     * @param bool $canInviteUsers
     * @param bool|null $canPostMessages
     * @param bool|null $canEditMessages
     * @param bool|null $canPinMessages
     *
     * @return $this
     */
    public static function make(
        $sAnonymous,
        $canManageChat,
        $canDeleteMessages,
        $canManageVideoChats,
        $canRestrictMembers,
        $canPromoteMembers,
        $canChangeInfo,
        $canInviteUsers,
        $canPostMessages = null,
        $canEditMessages = null,
        $canPinMessages = null
    ) {
        return new static([
            'is_anonymous' => $sAnonymous,
            'can_manage_chat' => $canManageChat,
            'can_delete_messages' => $canDeleteMessages,
            'can_manage_video_chats' => $canManageVideoChats,
            'can_restrict_members' => $canRestrictMembers,
            'can_promote_members' => $canPromoteMembers,
            'can_change_info' => $canChangeInfo,
            'can_invite_users' => $canInviteUsers,
            'can_post_messages' => $canPostMessages,
            'can_edit_messages' => $canEditMessages,
            'can_pin_messages' => $canPinMessages
        ]);
    }
}
