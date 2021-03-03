<?php

namespace App\Core;

class Config
{
    private static $configs = array();

    /**
     * Возвращает конфигурацию
     *
     * @param string $name Название конфигурации
     * 
     * @return array 
     */
    public static function get(string $name): array
    {
        if (!isset(self::$configs[$name])) {
            if (file_exists(CONFIGS_PATH . '/' . $name . '.php')) {
                self::$configs[$name] = require_once(CONFIGS_PATH . '/' . $name . '.php');
            } else {
                self::$configs[$name] = array();
            }
        }

        return self::$configs[$name];
    }
}
