<?php

namespace U89Man\TBot\Entities\Keyboards;

/**
 * @link https://core.telegram.org/bots/api#keyboardbuttonpolltype
 *
 * @method string|null getType()
 *
 * @method       $this setType(string $type)
 */
class KeyboardButtonPollType extends KeyboardEntity
{
    const TYPE_QUIZ = 'quiz';
    const TYPE_REGULAR = 'regular';


	/**
	 * @param string|null $type
     *
	 * @return $this
	 */
	public static function make($type = null)
    {
	    return new static([
	    	'type' => $type
		]);
	}

    /**
     * @return $this
     */
    public static function makeQuiz()
    {
        return self::make(self::TYPE_QUIZ);
    }

    /**
     * @return $this
     */
    public static function makeRegular()
    {
        return self::make(self::TYPE_REGULAR);
    }
}
