<?php

// check if we are running from console

if ('cli' !== php_sapi_name()) {
    die('This script has to be run from console'.PHP_EOL);
}

// since console has no DOCUMENT_ROOT variable, we should locate it

if (empty($_SERVER['DOCUMENT_ROOT'])) {
    $documentRoot = function ($dir = __DIR__) use (&$documentRoot) {
        if (is_dir($dir.'/bitrix')) {
            return $dir;
        }
    
        if ('/' === $dir) {
            die('Failed to locate document root'.PHP_EOL);
        }
    
        return $documentRoot(dirname($dir));
    };
    
    $_SERVER['DOCUMENT_ROOT'] = $documentRoot();
}

// define magic variables
defined('BX_PUBLIC_TOOLS') or define('BX_PUBLIC_TOOLS', true);
defined('NO_KEEP_STATISTIC') or define('NO_KEEP_STATISTIC', true);
defined('NOT_CHECK_PERMISSIONS') or define('NOT_CHECK_PERMISSIONS', true);
defined('BX_SECURITY_SESSION_VIRTUAL') or define('BX_SECURITY_SESSION_VIRTUAL', true);

// run forever

ini_set('max_execution_time', 0);

// include bitrix prolog

require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';

// include console module

if (!\Bitrix\Main\Loader::IncludeModule('magnifico.console')) {
    die('Failed to include module "magnifico.console"'.PHP_EOL);
}

// include every installed module so they can add their commands

foreach (\Bitrix\Main\ModuleManager::getInstalledModules() as $module) {
    if (!\Bitrix\Main\Loader::includeModule($module['ID'])) {
        // not sure if it's a problem?
    }
}

// run application

$app = \Magnifico\Console\Application::getInstance();
$app->run();

// include bitrix epilog

require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php';
