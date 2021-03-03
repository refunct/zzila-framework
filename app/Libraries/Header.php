<?php

namespace App\Libraries;

class Header
{

    /**
     * Устанавливает код отвта в Response Headers и завершает скрипт
     * 
     * @param int $code Код ответа
     * @param string $url `[опционально]` Путь для перенаправления (работает для ошибок 3хх)
     * 
     * @return void
     * 
     * @link https://developer.mozilla.org/ru/docs/Web/HTTP/Status
     */
    public static function setHttpCode(int $code, string $url = ''): void
    {
        http_response_code($code);
        if ($code >= 300 && $code <= 399) {
            header('Location: ' . ($url ?? $_SERVER['SERVER_NAME']));
        }
        die();
    }

    /**
     * Устанавливает Content-Type и charset в Response Headers
     * 
     * @param string $mime `[опционально]` Mime тип страницы
     * @param string $charset `[опционально]` Кодировка страниц
     * 
     * @return void
     * 
     * @link https://developer.mozilla.org/ru/docs/Web/HTTP/Basics_of_HTTP/MIME_types
     * @link https://developer.mozilla.org/ru/docs/Web/HTML/Element/meta#attr-charset
     */
    public static function setContent(string $mime = 'text/html', string $charset = 'utf-8'): void
    {
        header('Content-Type: ' . $mime . '; charset=' . $charset);
    }

    /**
     * Устанавливает язык в Response Headers
     * 
     * @param string $lang `[опционально]` Код языка в формате ISO 639-1
     * 
     * @return void
     * 
     * @link https://ru.wikipedia.org/wiki/%D0%9A%D0%BE%D0%B4%D1%8B_%D1%8F%D0%B7%D1%8B%D0%BA%D0%BE%D0%B2#%D0%9A%D0%BE%D0%B4%D1%8B_%D1%8F%D0%B7%D1%8B%D0%BA%D0%BE%D0%B2_%D0%BF%D0%BE_ISO_639_%D0%B8_%D0%93%D0%9E%D0%A1%D0%A2_7.75-97
     * @link https://ru.wikipedia.org/wiki/%D0%A1%D0%BF%D0%B8%D1%81%D0%BE%D0%BA_%D1%8F%D0%B7%D1%8B%D0%BA%D0%BE%D0%B2_%D0%BF%D0%BE_%D0%BA%D0%BE%D0%BB%D0%B8%D1%87%D0%B5%D1%81%D1%82%D0%B2%D1%83_%D0%BD%D0%BE%D1%81%D0%B8%D1%82%D0%B5%D0%BB%D0%B5%D0%B9
     */
    public static function setLang(string $lang = 'ru'): void
    {
        header('Content-language: ' . $lang);
    }

    /**
     * Устанавливает язык в Response Headers
     * 
     * @param string $index `[опционально]` Тип индексации роботами
     * 
     * @return void
     * 
     * @link https://developers.google.com/search/docs/advanced/robots/robots_meta_tag?hl=ru
     * @link https://yandex.ru/support/webmaster/controlling-robot/meta-robots.html
     */
    public static function setRobotIndex(string $index = 'all'): void
    {
        header('X-Robots-Tag: ' . $index);
    }

    /**
     * Устанавливает Cookie
     * 
     * @param string $name Имя cookie
     * @param string $value Значение cookie
     * @param string $duration Время жизни cookie в секундах
     * 
     * @return void
     */
    public static function setCookie(string $name, string $value, int $duration): void
    {
        if (empty($_COOKIE[$name]) || (!empty($_COOKIE[$name]) && $_COOKIE[$name] != $value)) {
            setcookie($name, $value, time() + $duration, '/', $_SERVER['HTTP_HOST']);
        }
    }

    /**
     * Устанавливает canonical в Response Headers
     * 
     * @param string $url Адрес каконичной страницы
     * 
     * @return void
     */
    public static function setCanonical(string $url): void
    {
        header('Link: <'.$url.'>; rel="canonical"');
    }
}