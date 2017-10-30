# bitrix-console

# Как поставить

1. Ставим пакет через composer

```
composer require magnifico/bitrix-console:^0.1
```

2. Ставим симлинк с именем "magnifico.console" из директории bitrix'а на местоположение пакета, например:

```
cd /home/bitrix/www/bitrix/modules
ln -s ../../../vendor/magnifico/bitrix-console magnifico.console
```

3. Устанавливаем модуль в админке битрикса

4. Создаем где-нибудь файл "manage.php":

```
<?php

# Определяем, где находится DOCUMENT_ROOT
$_SERVER['DOCUMENT_ROOT'] = '/home/bitrix/www';

# Включаем служебный скрипт, который сделает все остальное
require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/magnifico.console/manage.php';
```

5. Пользуемся

# Как работать с модулем

Чтобы добавить свои команды в инстанс приложения, нужно подписаться на событие "OnBeforeRun":

```php
$eventManager = \Bitrix\Main\EventManager::getInstance();

$eventManager->addEventHandler('magnifico.console', 'OnBeforeRun', function(\Bitrix\Main\Event $event){
    $app = $event->getParameter('app');
    $app->add(new class() extends \Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('foobar');
        }
    });
});
```

Перед запуском приложения скрипт manage.php загрузит все установленные в системе модули, чтобы они могли подписаться на указанное событие приведенным выше способом.

В остальном работа идентична приложению из symfony/console.
