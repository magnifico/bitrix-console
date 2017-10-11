<?php

use Bitrix\Main\ModuleManager;

class Magnifico_Console extends \CModule
{
    public $MODULE_ID = 'magnifico.console';

    public $MODULE_VERSION = '1.0.0';

    public $MODULE_VERSION_DATE = '2014-06-19 17:49:00';

    public $MODULE_NAME = 'Console application';

    public $MODULE_DESCRIPTION = 'Integration of symfony/console and bitrix';

    public $PARTNER_NAME = 'Magnifico';

    public $PARTNER_URI = 'https://magnifico.pro';

    public function doInstall()
    {
        ModuleManager::registerModule('magnifico.console');
    }

    public function doUninstall()
    {
        ModuleManager::unRegisterModule('magnifico.console');
    }
}
