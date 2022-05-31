<?php

namespace U89Man\TBot\Entities\Stickers;

use U89Man\TBot\Entities\Entity;

/**
 * @link https://core.telegram.org/bots/api#maskposition
 *
 * @method string getPoint()
 * @method  float getXShift()
 * @method  float getYShift()
 * @method  float getScale()
 */
class MaskPosition extends Entity
{
	const POINT_FOREHEAD = 'forehead';
	const POINT_EYES = 'eyes';
	const POINT_MOUTH = 'mouth';
	const POINT_CHIN = 'chin';


    /**
     * @return bool
     */
    public function isForehead()
    {
        return $this->getPoint() == self::POINT_FOREHEAD;
    }

    /**
     * @return bool
     */
    public function isEyes()
    {
        return $this->getPoint() == self::POINT_EYES;
    }

    /**
     * @return bool
     */
    public function isMouth()
    {
        return $this->getPoint() == self::POINT_MOUTH;
    }

    /**
     * @return bool
     */
    public function isChin()
    {
        return $this->getPoint() == self::POINT_CHIN;
    }
}
