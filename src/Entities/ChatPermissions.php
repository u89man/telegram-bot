<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#chatpermissions
 *
 * @method  bool getCanSendMessages()
 * @method  bool getCanSendMediaMessages()
 * @method  bool getCanSendOtherMessages()
 * @method  bool getCanAddWebPagePreviews()
 * @method  bool getCanSendPolls()
 * @method  bool getCanInviteUsers()
 * @method  bool getCanPinMessages()
 * @method  bool getCanChangeInfo()
 *
 * @method $this setCanSendMessages(bool $canSendMessages)
 * @method $this setCanSendMediaMessages(bool $canSendMediaMessages)
 * @method $this setCanSendOtherMessages(bool $canSendOtherMessages)
 * @method $this setCanAddWebPagePreviews(bool $canAddWebPagePreviews)
 * @method $this setCanSendPolls(bool $canSendPolls)
 * @method $this setCanInviteUsers(bool $canInviteUsers)
 * @method $this setCanPinMessages(bool $canPinMessages)
 * @method $this setCanChangeInfo(bool $canChangeInfo)
 */
class ChatPermissions extends Entity
{
    /**
     * @param bool|null $canSendMessages
     * @param bool|null $canSendMediaMessages
     * @param bool|null $canSendOtherMessages
     * @param bool|null $canAddWebPagePreviews
     * @param bool|null $canSendPolls
     * @param bool|null $canInviteUsers
     * @param bool|null $canPinMessages
     * @param bool|null $canChangeInfo
     *
     * @return $this
     */
    public static function make(
        $canSendMessages = null,
        $canSendMediaMessages = null,
        $canSendOtherMessages = null,
        $canAddWebPagePreviews = null,
        $canSendPolls = null,
        $canInviteUsers = null,
        $canPinMessages = null,
        $canChangeInfo = null
    ) {
	    return new static([
	        'can_send_messages' => $canSendMessages,
	        'can_send_media_messages' => $canSendMediaMessages,
	        'can_send_polls' => $canSendPolls,
	        'can_send_other_messages' => $canSendOtherMessages,
	        'can_add_web_page_previews' => $canAddWebPagePreviews,
	        'can_change_info' => $canChangeInfo,
	        'can_invite_users' => $canInviteUsers,
	        'can_pin_messages' => $canPinMessages
        ]);
	}
}
