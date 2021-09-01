<?php

namespace U89Man\TBot\Entities\Poll;

use U89Man\TBot\Entities\Entity;
use U89Man\TBot\Entities\MessageEntity;

/**
 * @link https://core.telegram.org/bots/api#poll
 *
 * @method               string getId()
 * @method               string getQuestion()
 * @method         PollOption[] getOptions()
 * @method                  int getTotalVoterCount()
 * @method                 bool getIsClosed()
 * @method                 bool getIsAnonymous()
 * @method               string getType()
 * @method                 bool getAllowsMultipleAnswers()
 * @method             int|null getCorrectOptionId()
 * @method          string|null getExplanation()
 * @method MessageEntity[]|null getExplanationEntities()
 * @method             int|null getOpenPeriod()
 * @method             int|null getCloseDate()
 */
class Poll extends Entity
{
	const TYPE_QUIZ = 'quiz';
	const TYPE_REGULAR = 'regular';


    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'options' => [PollOption::class],
            'explanation_entities' => [MessageEntity::class]
        ];
    }

    /**
     * @return bool
     */
    public function isQuiz()
    {
        return $this->getType() == Poll::TYPE_QUIZ;
    }

    /**
     * @return bool
     */
    public function isRegular()
    {
        return $this->getType() == Poll::TYPE_REGULAR;
    }
}
