## Telegram Bot 0.5.4 ([5.1](https://core.telegram.org/bots/api#march-9-2021))

##### Требования

+ `PHP >= 7.0`


##### Установка

```
composer require u89man/telegram-bot
```


##### Примеры

```php
<?php

require __DIR__.'/vendor/autoload.php';

use U89Man\TBot\Api;
use U89Man\TBot\Entities\Message;
use U89Man\TBot\TBot;

$token = '123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11';

$bot = new TBot($token);

$bot->addMessageHandler(function (Api $api, Message $message) {
    // Обработка команды 
    if ($message->getBotCommand() == '/start') {
        $api->sendMessage($message->getChat()->getId(), 'Добро пожаловать!');
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

$bot->addAdmin(56781234);

$bot->addMessageHandler(function (Api $api, Message $message) {
    if (TBot::isAdmin($message->getFrom()->getId())) {
        // admin
    } else {
        // simple user
    }
});

$bot->run();
```

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
