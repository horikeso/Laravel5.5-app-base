<?php

namespace App\Models;

trait BaseTrait
{

    private static $instance;

    private function __construct()
    {
        // new only private
    }

    public static function getInstance()
    {
        if ( ! self::$instance)
        {
            self::$instance = new static();
        }

        return self::$instance;
    }
}
