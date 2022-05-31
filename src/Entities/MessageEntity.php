<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#messageentity
 *
 * @method      string getType()
 * @method         int getOffset()
 * @method         int getLength()
 * @method string|null getUrl()
 * @method   User|null getUser()
 * @method string|null getLanguage()
 *
 * @method       $this setType(string $type)
 * @method       $this setOffset(int $offset)
 * @method       $this setLength(int $length)
 * @method       $this setUrl(string $url)
 * @method       $this setUser(User $user)
 * @method       $this setLanguage(string $language)
 */
class MessageEntity extends Entity
{
	const TYPE_MENTION = 'mention';
	const TYPE_HASHTAG = 'hashtag';
	const TYPE_CASHTAG = 'cashtag';
	const TYPE_BOT_COMMAND = 'bot_command';
	const TYPE_URL = 'url';
	const TYPE_EMAIL = 'email';
	const TYPE_PHONE_NUMBER = 'phone_number';
	const TYPE_BOLD = 'bold';
	const TYPE_ITALIC = 'italic';
	const TYPE_UNDERLINE = 'underline';
	const TYPE_STRIKETHROUGH = 'strikethrough';
    const TYPE_SPOILER = 'spoiler';
	const TYPE_CODE = 'code';
	const TYPE_PRE = 'pre';
	const TYPE_TEXT_LINK = 'text_link';
	const TYPE_TEXT_MENTION = 'text_mention';


    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'user' => User::class
        ];
    }

    /**
     * @param string $type
     * @param int $offset
     * @param int $length
     * @param string|null $url
     * @param User|null $user
     * @param string|null $language
     *
     * @return $this
     */
    public static function make(
        $type,
        $offset,
        $length,
        $url = null,
        $user = null,
        $language = null
    ) {
        return new static([
            'type' => $type,
            'offset' => $offset,
            'length' => $length,
            'url' => $url,
            'user' => $user,
            'language' => $language
        ]);
    }

    /**
     * @return bool
     */
    public function isMention()
    {
        return $this->getType() == self::TYPE_MENTION;
    }

    /**
     * @return bool
     */
    public function isHashtag()
    {
        return $this->getType() == self::TYPE_HASHTAG;
    }

    /**
     * @return bool
     */
    public function isCashtag()
    {
        return $this->getType() == self::TYPE_CASHTAG;
    }

    /**
     * @return bool
     */
    public function isBotCommand()
    {
        return $this->getType() == self::TYPE_BOT_COMMAND;
    }

    /**
     * @return bool
     */
    public function isUrl()
    {
        return $this->getType() == self::TYPE_URL;
    }

    /**
     * @return bool
     */
    public function isEmail()
    {
        return $this->getType() == self::TYPE_EMAIL;
    }

    /**
     * @return bool
     */
    public function isPhoneNumber()
    {
        return $this->getType() == self::TYPE_PHONE_NUMBER;
    }

    /**
     * @return bool
     */
    public function isBold()
    {
        return $this->getType() == self::TYPE_BOLD;
    }

    /**
     * @return bool
     */
    public function isItalic()
    {
        return $this->getType() == self::TYPE_ITALIC;
    }

    /**
     * @return bool
     */
    public function isUnderline()
    {
        return $this->getType() == self::TYPE_UNDERLINE;
    }

    /**
     * @return bool
     */
    public function isStrikethrough()
    {
        return $this->getType() == self::TYPE_STRIKETHROUGH;
    }

    /**
     * @return bool
     */
    public function isSpoiler()
    {
        return $this->getType() == self::TYPE_SPOILER;
    }

    /**
     * @return bool
     */
    public function isCode()
    {
        return $this->getType() == self::TYPE_CODE;
    }

    /**
     * @return bool
     */
    public function isPre()
    {
        return $this->getType() == self::TYPE_PRE;
    }

    /**
     * @return bool
     */
    public function isTextLink()
    {
        return $this->getType() == self::TYPE_TEXT_LINK;
    }

    /**
     * @return bool
     */
    public function isTextMention()
    {
        return $this->getType() == self::TYPE_TEXT_MENTION;
    }
}
