<?php

namespace App\Libraries;

class Error
{

    /**
     * Завершает скрипт и выводит текст ошибки на экран 
     * 
     * @param string $msg `[опционально]` Текст ошибки
     * 
     * @return void
    */
    public static function set(string $msg = ''): void
    {
        die($msg);
    }
}
