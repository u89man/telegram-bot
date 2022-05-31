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
	const REQUEST_CONTACT = 'request_contact';
	const REQUEST_LOCATION = 'request_location';
	const REQUEST_POLL = 'request_poll';
	const WEB_APP = 'web_app';


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
        return $this->setRequest(KeyboardButton::REQUEST_CONTACT, true);
    }

    /**
     * @return $this
     */
    public function setRequestLocation()
    {
        return $this->setRequest(KeyboardButton::REQUEST_LOCATION, true);
    }

    /**
     * @param string $pollType
     *
     * @return $this
     */
    public function setRequestPool($pollType)
    {
        return $this->setRequest(KeyboardButton::REQUEST_POLL, $pollType);
    }

    /**
     * @param WebAppInfo $webApp
     *
     * @return $this
     */
    public function setWebApp($webApp)
    {
        return $this->setRequest(KeyboardButton::WEB_APP, $webApp);
    }

    /**
     * @param string $text
     * @param string|null $request
     * @param WebAppInfo|KeyboardButtonPollType|bool|null $value
     *
     * @return $this
     */
	public static function make($text, $request = null, $value= null)
    {
		$entity = new static([
			'text' => $text
		]);

		if (! is_null($request) && ! is_null($value)) {
            $entity->setRequest($request, $value);
        }

	    return $entity;
	}

	/**
	 * @param string $text
     *
	 * @return $this
	 */
	public static function makeContact($text)
    {
	    return static::make($text)->setRequestContact();
	}

	/**
	 * @param string $text
     *
	 * @return $this
	 */
	public static function makeLocation($text)
    {
	    return static::make($text)->setRequestLocation();
	}

	/**
	 * @param string $text
	 * @param string $pollType
     *
	 * @return $this
	 */
	public static function makePoll($text, $pollType)
    {
	    return static::make($text)->setRequestPool($pollType);
	}

	/**
	 * @param string $text
	 * @param WebAppInfo $webApp
     *
	 * @return $this
	 */
	public static function makeWebApp($text, $webApp)
    {
	    return static::make($text)->setWebApp($webApp);
	}

    /**
     * @return string|null
     */
    public function getRequest()
    {
        $requests = [
            KeyboardButton::REQUEST_CONTACT,
            KeyboardButton::REQUEST_LOCATION,
            KeyboardButton::REQUEST_POLL,
            KeyboardButton::WEB_APP
        ];

        foreach ($requests as $request) {
            if ($this->has($request)) return $request;
        }

        return null;
    }

    /**
     * @param string $request
     * @param WebAppInfo|KeyboardButtonPollType|bool $value
     *
     * @return $this
     */
    public function setRequest($request, $value)
    {
        $requests = [
            KeyboardButton::REQUEST_CONTACT,
            KeyboardButton::REQUEST_LOCATION,
            KeyboardButton::REQUEST_POLL,
            KeyboardButton::WEB_APP
        ];

        if (! in_array($request, $requests)) {
            throw new Exception('Не корректный запрос кнопки');
        }

        array_map(array($this, 'remove'), $requests);

        return $this->set($request, $value);
    }

    /**
     * @return bool
     */
    public function isRequestContact()
    {
        return $this->getRequest() == KeyboardButton::REQUEST_CONTACT;
    }

    /**
     * @return bool
     */
    public function isRequestLocation()
    {
        return $this->getRequest() == KeyboardButton::REQUEST_LOCATION;
    }

    /**
     * @return bool
     */
    public function isRequestPool()
    {
        return $this->getRequest() == KeyboardButton::REQUEST_POLL;
    }

    /**
     * @return bool
     */
    public function isWebApp()
    {
        return $this->getRequest() == KeyboardButton::WEB_APP;
    }
}
