<?php

namespace U89Man\TBot\Entities\Keyboards;

use Exception;
use U89Man\TBot\Entities\WebAppInfo;

/**
 * @link https://core.telegram.org/bots/api#keyboardbutton
 *
 * @method                      string getText()
 * @method                   bool|null getRequestContact()
 * @method                   bool|null getRequestLocation()
 * @method KeyboardButtonPollType|null getRequestPoll()
 * @method             WebAppInfo|null getWebApp()
 *
 * @method                       $this setText(string $text)
 */
class KeyboardButton extends Keyboard
{
	const TYPE_REQUEST_CONTACT = 'request_contact';
	const TYPE_REQUEST_LOCATION = 'request_location';
	const TYPE_REQUEST_POLL = 'request_poll';
	const TYPE_WEB_APP = 'web_app';


    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'request_poll' => KeyboardButtonPollType::class,
            'web_app' => WebAppInfo::class
        ];
    }

    /**
     * @return $this
     */
    public function setRequestContact()
    {
        return $this->setType(KeyboardButton::TYPE_REQUEST_CONTACT, true);
    }

    /**
     * @return $this
     */
    public function setRequestLocation()
    {
        return $this->setType(KeyboardButton::TYPE_REQUEST_LOCATION, true);
    }

    /**
     * @param KeyboardButtonPollType $pollType
     *
     * @return $this
     */
    public function setRequestPool(KeyboardButtonPollType $pollType)
    {
        return $this->setType(KeyboardButton::TYPE_REQUEST_POLL, $pollType);
    }

    /**
     * @param WebAppInfo $webApp
     *
     * @return $this
     */
    public function setWebApp(WebAppInfo $webApp)
    {
        return $this->setType(KeyboardButton::TYPE_WEB_APP, $webApp);
    }

    /**
     * @param string $text
     * @param string|null $type
     * @param WebAppInfo|KeyboardButtonPollType|bool|null $value
     *
     * @return $this
     */
	public static function make($text, $type = null, $value= null)
    {
		$button = new static([
			'text' => $text
		]);

		if (! is_null($type) && ! is_null($value)) {
            $button->setType($type, $value);
        }

	    return $button;
	}

	/**
	 * @param string $text
     *
	 * @return $this
	 */
	public static function makeRequestContact($text)
    {
	    return static::make($text)->setRequestContact();
	}

	/**
	 * @param string $text
     *
	 * @return $this
	 */
	public static function makeRequestLocation($text)
    {
	    return static::make($text)->setRequestLocation();
	}

	/**
	 * @param string $text
	 * @param KeyboardButtonPollType $pollType
     *
	 * @return $this
	 */
	public static function makeRequestPoll($text, KeyboardButtonPollType $pollType)
    {
	    return static::make($text)->setRequestPool($pollType);
	}

	/**
	 * @param string $text
	 * @param WebAppInfo $webApp
     *
	 * @return $this
	 */
	public static function makeWebApp($text, WebAppInfo $webApp)
    {
	    return static::make($text)->setWebApp($webApp);
	}

    /**
     * @return string|null
     */
    public function getType()
    {
        $types = [
            KeyboardButton::TYPE_REQUEST_CONTACT,
            KeyboardButton::TYPE_REQUEST_LOCATION,
            KeyboardButton::TYPE_REQUEST_POLL,
            KeyboardButton::TYPE_WEB_APP
        ];

        foreach ($types as $type) {
            if ($this->has($type)) return $type;
        }

        return null;
    }

    /**
     * @param string $type
     * @param WebAppInfo|KeyboardButtonPollType|bool $value
     *
     * @return $this
     */
    protected function setType($type, $value)
    {
        $types = [
            KeyboardButton::TYPE_REQUEST_CONTACT,
            KeyboardButton::TYPE_REQUEST_LOCATION,
            KeyboardButton::TYPE_REQUEST_POLL,
            KeyboardButton::TYPE_WEB_APP
        ];

        if (! in_array($type, $types)) {
            throw new Exception('Не корректный запрос кнопки');
        }

        array_map(array($this, 'remove'), $types);

        return $this->set($type, $value);
    }

    /**
     * @return bool
     */
    public function isRequestContact()
    {
        return $this->getType() == KeyboardButton::TYPE_REQUEST_CONTACT;
    }

    /**
     * @return bool
     */
    public function isRequestLocation()
    {
        return $this->getType() == KeyboardButton::TYPE_REQUEST_LOCATION;
    }

    /**
     * @return bool
     */
    public function isRequestPool()
    {
        return $this->getType() == KeyboardButton::TYPE_REQUEST_POLL;
    }

    /**
     * @return bool
     */
    public function isWebApp()
    {
        return $this->getType() == KeyboardButton::TYPE_WEB_APP;
    }
}
