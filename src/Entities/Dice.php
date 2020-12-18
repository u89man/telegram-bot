<?php

namespace U89Man\TBot\Entities;

/**
 * @link https://core.telegram.org/bots/api#dice
 *
 * @method string getEmoji()
 * @method    int getValue()
 */
class Dice extends Entity
{
    const EMOJI_DICE = '🎲';
    const EMOJI_DARTS = '🎯';
    const EMOJI_BASKETBALL = '🏀';
    const EMOJI_FOOTBALL = '⚽';
    const EMOJI_SLOT_MACHINE = '🎰';
}
