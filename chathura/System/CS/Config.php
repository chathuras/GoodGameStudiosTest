<?php

namespace CS;

/**
 * Class Config handles Application configs
 * @package CS
 */
class Config {

    private static $_configs = null;

    public static function setConfigs($configs)
    {
        self::$_configs = $configs;
    }

    public static function getConfigs()
    {
        return self::$_configs;
    }

    public static function get($key)
    {
        return self::$_configs[$key];
    }
} 