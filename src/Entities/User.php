<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#user
 *
 * @method         int getId()
 * @method        bool getIsBot()
 * @method      string getFirstName()
 * @method string|null getLastName()
 * @method string|null getUsername()
 * @method string|null getLanguageCode()
 * @method   bool|null getCanJoinGroups()
 * @method   bool|null getCanReadAllGroupMessages()
 * @method   bool|null getSupportsInlineQueries()
 *
 * @method       $this setId(int $id)
 * @method       $this setIsBot(bool $isBot)
 * @method       $this setFirstName(string $firstName)
 * @method       $this setLastName(string $lastName)
 * @method       $this setUsername(string $username)
 * @method       $this setLanguageCode(string $languageCode)
 * @method       $this setCanJoinGroups(bool $canJoinGroups)
 * @method       $this setCanReadAllGroupMessages(bool $canReadAllGroupMessages)
 * @method       $this setSupportsInlineQueries(bool $supportsInlineQueries)
 */
class User extends Entity
{
    /**
     * @param int $id
     * @param bool $isBot
     * @param string $firstName
     * @param string|null $lastName
     * @param string|null $username
     * @param string|null $languageCode
     * @param bool|null $canJoinGroups
     * @param bool|null $canReadAllGroupMessages
     * @param bool|null $supportsInlineQueries
     *
     * @return $this
     */
    public static function make(
        $id,
        $isBot,
        $firstName,
        $lastName = null,
        $username = null,
        $languageCode = null,
        $canJoinGroups = null,
        $canReadAllGroupMessages = null,
        $supportsInlineQueries = null
    ) {
        return new static([
            'id' => $id,
            'is_bot' => $isBot,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'username' => $username,
            'language_code' => $languageCode,
            'can_join_groups' => $canJoinGroups,
            'can_read_all_group_messages' => $canReadAllGroupMessages,
            'supports_inline_queries' => $supportsInlineQueries
        ]);
    }

    /**
     * @return bool
     */
    public function isBot()
    {
        return $this->getIsBot();
    }
}
