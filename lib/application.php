<?php

namespace Magnifico\Console;

use Symfony\Component\Console\Application as ParentApplication;

class Application extends ParentApplication
{
    protected static $instance;

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}
