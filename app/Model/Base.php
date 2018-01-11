<?php

namespace App\Model;

abstract class Base
{

    private static $instance;

    private function __construct()
    {
        // new only private
    }

    public static function getInstance()
    {
        $class = get_called_class();

        if ( ! self::$instance)
        {
            self::$instance = new $class;
        }

        return self::$instance;
    }
}