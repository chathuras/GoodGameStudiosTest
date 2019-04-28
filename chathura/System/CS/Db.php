<?php

namespace CS;

/**
 * Class Db to Handle Db Connection
 * @package CS
 */
class Db {

    private static $_db = null;

    public static function get()
    {
        if (!self::$_db) {
            $dbConfig = Config::get('db');

            self::$_db = new \mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database']);
        }

        return self::$_db;
    }
} 