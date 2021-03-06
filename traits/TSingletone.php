<?php

namespace app\traits;


trait TSingletone
{
    private static $instance;

    private function __construct() {}
    private function __clone(){}
    private function __wakeup(){}

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
            if(method_exists(static::$instance,'init_instance')){
                static::$instance->init_instance();
            }
        }
        return static::$instance;
    }
}