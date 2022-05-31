## Клавиатуры

#### [Пользовательские](https://core.telegram.org/bots#keyboards)

```php
// [1.1] Клавиатура с простой (текстовой) кнопкой ответа.

use U89Man\TBot\Entities\Keyboards\ReplyKeyboardMarkup as RKeyboard;

$keyboard = RKeyboard::make([
    ['Текст_кнопки']
]);
```

```php
// [1.2] Клавиатура с простой кнопкой ответа.

use U89Man\TBot\Entities\Keyboards\ReplyKeyboardMarkup as RKeyboard;
use U89Man\TBot\Entities\Keyboards\KeyboardButton as Button;

// ...

$keyboard = RKeyboard::make([
    [Button::make('Текст_кнопки')]
]);
```

```php
// [2] Клавиатура с кнопкой предложения отправить боту контакта пользователя.

use U89Man\TBot\Entities\Keyboards\ReplyKeyboardMarkup as RKeyboard;
use U89Man\TBot\Entities\Keyboards\KeyboardButton as Button;

// ...

$keyboard = RKeyboard::make([
    [Button::makeRequestContact('Текст_кнопки')]
]);
```

```php
// [3] Клавиатура с кнопой предложения отправить боту местоположения пользователя. 

use U89Man\TBot\Entities\Keyboards\ReplyKeyboardMarkup as RKeyboard;
use U89Man\TBot\Entities\Keyboards\KeyboardButton as Button;

// ...

$keyboard = RKeyboard::make([
    [Button::makeRequestLocation('Текст_кнопки')]
]);
```

```php
// [4.1] Клавиатура с кнопкой предложения отправить боту опрос в виде викторины.

use U89Man\TBot\Entities\Keyboards\ReplyKeyboardMarkup as RKeyboard;
use U89Man\TBot\Entities\Keyboards\KeyboardButton as Button;
use U89Man\TBot\Entities\Keyboards\KeyboardButtonPollType as PollType;

// ...

$keyboard = RKeyboard::make([
    [Button::makeRequestPoll('Текст_кнопки', PollType::makeQuiz())]
]);
```

```php
// [4.2] Клавиатура с кнопкой предложения отправить боту простой опрос.

use U89Man\TBot\Entities\Keyboards\ReplyKeyboardMarkup as RKeyboard;
use U89Man\TBot\Entities\Keyboards\KeyboardButton as Button;
use U89Man\TBot\Entities\Keyboards\KeyboardButtonPollType as PollType;

// ...

$keyboard = RKeyboard::make([
    [Button::makeRequestPoll('Текст_кнопки', PollType::makeRegular()]
]);
```

```php
// [5] Клавиатура с кнопкой запуска приложения WebApp.

use U89Man\TBot\Entities\Keyboards\ReplyKeyboardMarkup as RKeyboard;
use U89Man\TBot\Entities\Keyboards\KeyboardButton as Button;
use U89Man\TBot\Entities\WebAppInfo;

// ...

$keyboard = RKeyboard::make([
    [Button::makeWebApp('Текст_кнопки', WebAppInfo::make('https://exaple.com')]
]);
```

```php
// [6] Клавиатура (команда) для отображения интерфейса ответа пользователю.

use U89Man\TBot\Entities\Keyboards\ForceReply;

// ...

$keyboard = ForceReply::make();
```

```php
// [7] Клавиатура (команда) для удаления утановленной ранее клавиатуры. 

use U89Man\TBot\Entities\Keyboards\ReplyKeyboardRemove as KeyboardRemove;

// ...

$keyboard = KeyboardRemove::make();
```

#### [Встраиваемые](https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating)

```php
// [8] Клавиатура с кнопкой авторизации пользователя на сайте.

use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup as IKeyboard;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardButton as IButton;
use U89Man\TBot\Entities\Keyboards\LoginUrl;

// ...

$keyboard = IKeyboard::make([
    [IButton::makeLoginUrl('Текст_кнопки', LoginUrl::make('https://example.com/auth'))]
]);
```

```php
// [9] Клавиатура с кнопкой отправки боту данных в запросе обратного вызова.

use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup as IKeyboard;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardButton as IButton;

// ...

$keyboard = IKeyboard::make([
    [IButton::makeCallbackData('Текст_кнопки', 'Строка_с_данными_запроса')]
]);
```

```php
// [10] Клавиатура с кнопкой переключения бота на встраиваемый запрос в выбираемый чат.

use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup as IKeyboard;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardButton as IButton;

// ...

$keyboard = IKeyboard::make([
    [IButton::makeSwitchInlineQuery('Текст_кнопки', 'Строка_с_данными_запроса')]
]);
```

```php
// [11] Клавиатура с кнопкой переключения бота на встраиваемый запрос в текущий чат.

use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup as IKeyboard;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardButton as IButton;

// ...

$keyboard = IKeyboard::make([
    [IButton::makeSwitchInlineQueryCurrentChat('Текст_кнопки', 'Строка_с_данными_запроса')]
]);
```

```php
// [12] Клавиатура с кнопкой содержащей описание игры.

use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup as IKeyboard;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardButton as IButton;
use U89Man\TBot\Entities\Games\CallbackGame;

// ...

$keyboard = IKeyboard::make([
    [IButton::makeCallbackGame('Текст_кнопки', CallbackGame::make())]
]);

// 13.02.2020
// Error: [Bad Request: BUTTON_TYPE_INVALID]
```

```php
// [13] Клавиатура с кнопкой оплаты.

use U89Man\TBot\Entities\Keyboards\InlineKeyboardMarkup as IKeyboard;
use U89Man\TBot\Entities\Keyboards\InlineKeyboardButton as IButton;

// ...

$keyboard = IKeyboard::make([
    [IButton::makePay('Текст_кнопки')]  
]);

// 13.02.2020
// Error: [Bad Request: BUTTON_TYPE_INVALID] 
```



