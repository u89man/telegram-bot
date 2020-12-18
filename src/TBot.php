<?php

namespace U89Man\TBot;

use Closure;
use Throwable;
use U89Man\TBot\Entities\Update;
use U89Man\TBot\Exceptions\InputException;
use U89Man\TBot\Exceptions\JsonException;

class TBot
{
    /**
     * Экземпляр Api.
     *
     * @var Api
     */
    protected $api;

    /**
     * Список обработчиков.
     *
     * @var array
     */
    protected $handlers;

    /**
     * Список идентификаторов администраторов.
     *
     * @var int[]
     */
    protected static $adminUsersId = array();

    /**
     * Входящие данные.
     *
     * @var string
     */
    protected $input;


    /**
     * Конструктор.
     *
     * @param string $token
     * @param array $handlers
     */
    public function __construct($token, array $handlers = array())
    {
        $this->api = new Api($token);

        foreach ($handlers as $type => $list) {
            $list = Utils::wrap($list);

            foreach ($list as $callback) {
                if ($callback instanceof Closure) {
                    $this->addHandler($type, $callback);
                }
            }
        }
    }

    /**
     * Получает экземпляр Api.
     *
     * @return Api
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * Добавляет администратора.
     *
     * @param int $userId
     *
     * @return void
     */
    public function addAdmin($userId)
    {
        self::$adminUsersId[] = $userId;
    }

    /**
     * Проверяет, является ли пользователь администратором.
     *
     * @param int $userId
     *
     * @return bool
     */
    public static function isAdmin($userId)
    {
        return in_array($userId, self::$adminUsersId);
    }

    /**
     * Устанавливает входные данные.
     *
     * @param string $input
     *
     * @return void
     */
    public function setInput($input)
    {
        $this->input = $input;
    }

    /**
     * Получает входные данные.
     *
     * @return string
     */
    protected function getInput()
    {
        if (! $this->input) {
            $this->setInput(file_get_contents('php://input'));
        }

        if (! $this->input) {
            throw new InputException('Отсутствуют входные данные');
        }

        return $this->input;
    }

    /**
     * Получает экземпляр входящего обновления.
     *
     * @return Update
     */
    protected function getUpdate()
    {
        $update = json_decode($this->getInput(), true);

        if (json_last_error()) {
            throw new JsonException(json_last_error_msg(), json_last_error());
        }

        return new Update($update);
    }

    /**
     * Загружает бота.
     *
     * @return void
     */
    protected function boot()
    {
        //
    }

    /**
     * Запускает бота.
     *
     * @return void
     */
    public function run()
    {
        try {
            $this->boot();
            $this->handleUpdate($this->getUpdate());
            $this->terminate();
        }
        catch (Throwable $e) {
            $this->error($e);
        }
    }

    /**
     * Завершает бота.
     *
     * @return void
     */
    protected function terminate()
    {
        //
    }

    /**
     * Обрабатывает ошибки.
     *
     * @param Throwable $e
     *
     * @return void
     */
    protected function error(Throwable $e)
    {
        throw $e;
    }

    /**
     * Обрабатывает входящее обновление.
     *
     * @param Update $update
     *
     * @return void
     */
    protected function handleUpdate(Update $update)
    {
        $type = $update->getType();

        if (! isset($this->handlers[$type])) {
            return;
        }

        $context = null;

        switch ($type) {
            case Update::TYPE_MESSAGE:
                $context = $update->getMessage();
                break;
            case Update::TYPE_EDITED_MESSAGE:
                $context = $update->getEditedMessage();
                break;
            case Update::TYPE_CHANNEL_POST:
                $context = $update->getChannelPost();
                break;
            case Update::TYPE_EDITED_CHANNEL_POST:
                $context = $update->getEditedChannelPost();
                break;
            case Update::TYPE_INLINE_QUERY:
                $context = $update->getInlineQuery();
                break;
            case Update::TYPE_CHOSEN_INLINE_RESULT:
                $context = $update->getChosenInlineResult();
                break;
            case Update::TYPE_CALLBACK_QUERY:
                $context = $update->getCallbackQuery();
                break;
            case Update::TYPE_SHIPPING_QUERY:
                $context = $update->getShippingQuery();
                break;
            case Update::TYPE_PRE_CHECKOUT_QUERY:
                $context = $update->getPreCheckoutQuery();
                break;
            case Update::TYPE_PASSPORT_DATA:
                $context = $update->getPassportData();
                break;
            case Update::TYPE_POLL:
                $context = $update->getPoll();
                break;
            case Update::TYPE_POLL_ANSWER:
                $context = $update->getPollAnswer();
                break;
        }

        if (! $context) {
            return;
        }

        foreach ($this->handlers[$type] as $handler) {
            if ($handler instanceof Closure) {
                call_user_func_array($handler, [$this->api, $context]);
            }
        }
    }

    /**
     * Добавляет обработчик.
     *
     * @param string $type
     * @param Closure $handler
     *
     * @return void
     */
    public function addHandler($type, Closure $handler)
    {
        $this->handlers[$type][] = $handler;
    }

    /**
     * Добавляет обработчик сообщения.
     *
     * @param Closure $handler
     *
     * @return void
     */
    public function addMessageHandler(Closure $handler)
    {
        $this->addHandler(Update::TYPE_MESSAGE, $handler);
    }

    /**
     * Добавляет обработчик измененного сообщения.
     *
     * @param Closure $handler
     *
     * @return void
     */
    public function addEditedMessageHandler(Closure $handler)
    {
        $this->addHandler(Update::TYPE_EDITED_MESSAGE, $handler);
    }

    /**
     * Добавляет обработчик поста.
     *
     * @param Closure $handler
     *
     * @return void
     */
    public function addChannelPostHandler(Closure $handler)
    {
        $this->addHandler(Update::TYPE_CHANNEL_POST, $handler);
    }

    /**
     * Добавляет обработчик измененного поста.
     *
     * @param Closure $handler
     *
     * @return void
     */
    public function addEditedChannelPostHandler(Closure $handler)
    {
        $this->addHandler(Update::TYPE_EDITED_CHANNEL_POST, $handler);
    }

    /**
     * Добавляет обработчик встроенного запроса.
     *
     * @param Closure $handler
     *
     * @return void
     */
    public function addInlineQueryHandler(Closure $handler)
    {
        $this->addHandler(Update::TYPE_INLINE_QUERY, $handler);
    }

    /**
     * Добавляет обработчик выбранного результата встроенного запроса.
     *
     * @param Closure $handler
     *
     * @return void
     */
    public function addChosenInlineResultHandler(Closure $handler)
    {
        $this->addHandler(Update::TYPE_CHOSEN_INLINE_RESULT, $handler);
    }

    /**
     * Добавляет обработчик запроса обратного вызова.
     *
     * @param Closure $handler
     *
     * @return void
     */
    public function addCallbackQueryHandler(Closure $handler)
    {
        $this->addHandler(Update::TYPE_CALLBACK_QUERY, $handler);
    }

    /**
     * Добавляет обработчик запроса на доставку.
     *
     * @param Closure $handler
     *
     * @return void
     */
    public function addShippingQueryHandler(Closure $handler)
    {
        $this->addHandler(Update::TYPE_SHIPPING_QUERY, $handler);
    }

    /**
     * Добавляет обработчик предварительного запроса оплаты.
     *
     * @param Closure $handler
     *
     * @return void
     */
    public function addPreCheckoutQueryHandler(Closure $handler)
    {
        $this->addHandler(Update::TYPE_PRE_CHECKOUT_QUERY, $handler);
    }

    /**
     * Добавляет обработчик данных Telegram Passport, которыми пользователь поделился с ботом.
     *
     * @param Closure $handler
     *
     * @return void
     */
    public function addPassportDataHandler(Closure $handler)
    {
        $this->addHandler(Update::TYPE_PASSPORT_DATA, $handler);
    }

    /**
     * Добавляет обработчик состояния опроса.
     *
     * @param Closure $handler
     *
     * @return void
     */
    public function addPollHandler(Closure $handler)
    {
        $this->addHandler(Update::TYPE_POLL, $handler);
    }

    /**
     * Добавляет обработчик ответа пользователя в неанонимном опросе.
     *
     * @param Closure $handler
     *
     * @return void
     */
    public function addPollAnswerHandler(Closure $handler)
    {
        $this->addHandler(Update::TYPE_POLL_ANSWER, $handler);
    }
}
