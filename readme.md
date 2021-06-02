## Telegram Bot 0.5.7 ([5.2](https://core.telegram.org/bots/api#april-26-2021))

##### Требования

+ `PHP >= 7.0`
+ `ext-curl`
+ `ext-mbstring`
+ `ext-json`


##### Установка

```
composer require u89man/telegram-bot
```


##### Примеры

Обработка команд.

```php
<?php

require __DIR__.'/vendor/autoload.php';

use U89Man\TBot\Api;
use U89Man\TBot\Entities\Message;
use U89Man\TBot\TBot;

$token = '123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11';

$bot = new TBot($token);

$bot->addMessageHandler(function (Api $api, Message $message) {
    $chatId = $message->getChat()->getId();

    if ($message->getBotCommand() == '/start') {
        $api->sendMessage($chatId, 'Добро пожаловать!');
    }
});

$bot->run();
```

```php
<?php

require __DIR__.'/vendor/autoload.php';

use U89Man\TBot\Api;
use U89Man\TBot\Entities\Message;
use U89Man\TBot\TBot;

$token = '123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11';

$bot = new TBot($token);

$bot->addMessageHandler(function (Api $api, Message $message) {
    $chatId = $message->getChat()->getId();

    switch ($message->getBotCommand()) {
        case '/start':
            $api->sendMessage($chatId, 'Привет');
            break;
        case '/stop':
            $api->sendMessage($chatId, 'Пока');
            break;
        default:
            // сообщение не является командой
    }
});

$bot->run();
```


Проверка статуса пользователя.

```php
<?php

require __DIR__.'/vendor/autoload.php';

use U89Man\TBot\Api;
use U89Man\TBot\Entities\Message;
use U89Man\TBot\TBot;

$token = '123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11';

$bot = new TBot($token);

$bot->addAdmin(56781234);

$bot->addMessageHandler(function (Api $api, Message $message) {
    $userId = $message->getFrom()->getId();

    if (TBot::isAdmin($userId)) {
        // админ
    } else {
        // пользователь
    }
});

$bot->run();
```

Регистрация обработчиков в конструкторе класса бота.

```php
<?php

require __DIR__.'/vendor/autoload.php';

use U89Man\TBot\Api;
use U89Man\TBot\Entities\CallbackQuery;
use U89Man\TBot\Entities\Message;
use U89Man\TBot\Entities\Update;
use U89Man\TBot\TBot;

$token = '123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11';

$bot = new TBot($token, [
    Update::TYPE_MESSAGE => [
        function (Api $api, Message $message) {
            // 
        }
    ],
    Update::TYPE_CALLBACK_QUERY => [
        function (Api $api, CallbackQuery $callbackQuery) {
            // 
        }
    ]
]);

$bot->run();
```

Допустимо регистрировать несколько одинаковых обработчиков, они будут выполнены в порядке очереди добавления.

```php
<?php

require __DIR__.'/vendor/autoload.php';

use U89Man\TBot\Api;
use U89Man\TBot\Entities\Message;
use U89Man\TBot\TBot;

$token = '123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11';

$bot = new TBot($token);

$bot->addMessageHandler(function (Api $api, Message $message) {
    // #1
});

$bot->addMessageHandler(function (Api $api, Message $message) {
    // #2
});

$bot->addMessageHandler(function (Api $api, Message $message) {
    // #3
});

$bot->run();
```

При необходимости можно переопределить некоторые методы класса TBot.

```php
<?php

use U89Man\TBot\Api;
use U89Man\TBot\Entities\Message;
use U89Man\TBot\TBot;

require __DIR__.'/vendor/autoload.php';


class MyBot extends TBot
{
    /**
     * Выполняется перед обработкой входящего обновления.
     */
    protected function boot()
    {
        // Регистрируем ID администратора
        $this->addAdmin(56781234);
        
        // Подменяем входные данные (json-строка присылаемая серверами телеграм)
        // Необходимо для локального тестирования
        $this->setInput('{"update_id":567801234,"message":{"message_id":234,"from":{"id":56781234,"is_bot":false,"first_name":"Name","username":"User","language_code":"ru"},"chat":{"id":56781234,"first_name":"Name","username":"User","type":"private"},"date":1608061225,"text":"/start","entities":[{"offset":0,"length":6,"type":"bot_command"}]}}');

        // Регистируем обработчик сообщений
        $this->addMessageHandler(function (Api $api, Message $message) {
            $chatId = $message->getChat()->getId();

            // Сообщение является командой
            if ($message->getBotCommand() == '/start') {
                $userId = $message->getFrom()->getId();

                if (static::isAdmin($userId)) {
                    $api->sendMessage($chatId, 'Привет, админ.');
                } else {
                    $api->sendMessage($chatId, 'Привет, пользователь.');
                }
            }
        });
    }

    /**
     * Собственный обработчик ошибок.
     *
     * @param Throwable $e
     */
    protected function error(Throwable $e)
    {
        // [31.12.2020 23:56:18] Сообщение исключения (/Some/Path/File.php:48)
        $text = '['.date('d.m.Y H:i:s').'] '.$e->getMessage().' ('.$e->getFile().':'.$e->getLine().')'.PHP_EOL;

        // Например: Запись ошибки в лог-файл
        file_put_contents('error.log', $text, FILE_APPEND);
    }

    /**
     * Выполняется после обработки входящего обновления.
     */
    protected function terminate()
    {
        //
    }
}


$token = '1351912164:AAE19wXCnuzcZQPloV0t_JLZpSwGsyUBJYY';

$bot = new MyBot($token);

$bot->run();
```



##### Доступные типы обработчиков

+ `Update::TYPE_MESSAGE`
+ `Update::TYPE_EDITED_MESSAGE`
+ `Update::TYPE_CHANNEL_POST`
+ `Update::TYPE_EDITED_CHANNEL_POST`
+ `Update::TYPE_INLINE_QUERY`
+ `Update::TYPE_CHOSEN_INLINE_RESULT`
+ `Update::TYPE_CALLBACK_QUERY`
+ `Update::TYPE_SHIPPING_QUERY`
+ `Update::TYPE_PRE_CHECKOUT_QUERY`
+ `Update::TYPE_PASSPORT_DATA`
+ `Update::TYPE_POLL`
+ `Update::TYPE_POLL_ANSWER`
+ `Update::TYPE_MY_CHAT_MEMBER`
+ `Update::TYPE_CHAT_MEMBER`



##### Доступные методы для регистрации обработчиков

+ `addMessageHandler()`
+ `addEditedMessageHandler()`
+ `addChannelPostHandler()`
+ `addEditedChannelPostHandler()`
+ `addInlineQueryHandler()`
+ `addChosenInlineResultHandler()`
+ `addCallbackQueryHandler()`
+ `addShippingQueryHandler()`
+ `addPreCheckoutQueryHandler()`
+ `addPassportDataHandler()`
+ `addPollHandler()`
+ `addPollAnswerHandler()`
+ `addMyChatMember()`
+ `addChatMember()`


##### Документация

+ [Доступные методы API](docs/Api.md)
+ [Клавиатуры](docs/Keyboards.md)
+ [Официальная документация](https://core.telegram.org/bots/api)
