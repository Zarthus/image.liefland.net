<?php

class Config
{
    private static $config;

    public static function get(): array
    {
        if (static::$config === null) {
            static::$config = require __DIR__ . '/../config/config.php';
        }

        return static::$config;
    }
}
