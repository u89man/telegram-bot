<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#botcommand
 *
 * @method string getCommand()
 * @method string getDescription()
 *
 * @method  $this setCommand(string $command)
 * @method  $this setDescription(string $description)
 */
class BotCommand extends Entity
{
	/**
	 * @param string $command
	 * @param string $description
	 *
	 * @return BotCommand
	 */
	public static function make($command, $description)
    {
		return new static([
			'command' => $command,
			'description' => $description
		]);
	}
}
