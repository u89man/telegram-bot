<?php

namespace U89Man\TBot\Entities\Inline\QueryResult;

use U89Man\TBot\Entities\Inline\Content\InputMessageContent;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup;

/**
 * @link https://core.telegram.org/bots/api#inlinequeryresultarticle
 *
 * @method                    string getType()
 * @method                    string getId()
 * @method                    string getTitle()
 * @method       InputMessageContent getInputMessageContent()
 * @method InlineKeyboardMarkup|null getReplyMarkup()
 * @method               string|null getUrl()
 * @method                 bool|null getHideUrl()
 * @method               string|null getDescription()
 * @method               string|null getThumbUrl()
 * @method                  int|null getThumbWidth()
 * @method                  int|null getThumbHeight()

 * @method                     $this setType(string $type)
 * @method                     $this setId(string $id)
 * @method                     $this setTitle(string $title)
 * @method                     $this setInputMessageContent(InputMessageContent $inputMessageContent)
 * @method                     $this setReplyMarkup(InlineKeyboardMarkup $replyMarkup)
 * @method                     $this setUrl(string $url)
 * @method                     $this setHideUrl(bool $hideUrl)
 * @method                     $this setDescription(string $description)
 * @method                     $this setThumbUrl(string $thumbUrl)
 * @method                     $this setThumbWidth(int $thumbWidth)
 * @method                     $this setThumbHeight(int $thumbHeight)
 */
class InlineQueryResultArticle extends InlineQueryResult
{
    /**
     * @return array
     */
    protected function subEntities()
    {
        return [
            'reply_markup' => InlineKeyboardMarkup::class,
            'input_message_content' => InputMessageContent::class
        ];
    }

	/**
	 * @param string $id
	 * @param string $title
	 * @param InputMessageContent $inputMessageContent
	 * @param InlineKeyboardMarkup|null $replyMarkup
	 * @param string|null $url
	 * @param bool|null $hideUrl
	 * @param string|null $description
	 * @param string|null $thumbUrl
	 * @param int|null $thumbWidth
	 * @param int|null $thumbHeight
	 *
	 * @return $this
	 */
	public static function make(
			$id,
	    	$title,
	    	$inputMessageContent,
	    	$replyMarkup = null,
	    	$url = null,
	    	$hideUrl = null,
	    	$description = null,
	    	$thumbUrl = null,
	    	$thumbWidth = null,
	    	$thumbHeight = null
	) {
	    return new static([
	    	'type' => self::TYPE_ARTICLE,
	    	'id' => $id,
	    	'title' => $title,
	    	'input_message_content' => $inputMessageContent,
	    	'reply_markup' => $replyMarkup,
	    	'url' => $url,
	    	'hide_url' => $hideUrl,
	    	'description' => $description,
	    	'thumb_url' => $thumbUrl,
	    	'thumb_width' => $thumbWidth,
	    	'thumb_height' => $thumbHeight
		]);
	}
}
