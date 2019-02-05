<?php

namespace App\Models\Database;

trait BaseTrait
{

    private static $instance;
    protected $table_name;

    private function __construct()
    {
        $class_name_explode_list = explode("\\", get_class($this));
        $this->table_name = snake_case(end($class_name_explode_list));
    }

    public static function getInstance()
    {
        if ( ! self::$instance)
        {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function getTableName()
    {
        return $this->table_name;
    }
}
