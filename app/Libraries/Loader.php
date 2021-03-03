<?php

namespace App\Libraries;

use App\Libraries\Error as Error;

trait Loader
{

    /**
     * Загружает файл
     *
     * Проверяет наличие и возвращает файл из $path
     * 
     * @param string $path Путь до файла
     * @param bool $error `[опционально]` Нужно ли завершать работу скрипта, если файл не найдет. true - завершать, false - не завершать
     * 
     * @return mixed 
     */
    public function loadFile(string $path, bool $error = true): mixed
    {
        if (file_exists($path)) {
            return require_once($path);
        } else {
            if ($error) Error::set('Файл "' . $path . '" не найден');
        }
    }
}
