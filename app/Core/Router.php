<?php

namespace App\Core;

use App\Core\Config as Config;
use App\Core\Viewer as Viewer;
use App\Libraries\Header as Header;

class Router
{
    /**
     * Ищет и запускает контроллер
     *
     * Передает в контроллер массив $page_data
     * В $page_data записываются все данные станицы из конфигурации routes,
     * а также дополнительные поля clean_path, current_path, url, host, lang.
     * * clean_path - путь без языка. Если https://zzila.com/ru/to/path, то clean_path = /to/path
     * * current_path - путь с языком. Если https://zzila.com/ru/to/path, то current_path = /ru/to/path
     * * url - Протокол://хост/путь. Если https://zzila.com/ru/to/path?query=hi, то url = https://zzila.com/ru/to/path
     * * host - Протокол://хост. Если https://zzila.com/ru/to/path?query=hi, то host = https://zzila.com
     * * lang - Язык из пути. Если https://zzila.com/ru/to/path?query=hi, то lang = ru
     * 
     * @return void
     */
    public function routing(): void
    {
        $config_routes = Config::get('routes');
        $config_langs = Config::get('langs');
        $config_app = Config::get('app');

        $clean_path = $this->getCleanPath();
        $user_lang = $this->getLang($config_langs);
        $target_path = '';

        if (!empty($config_app['multilingual']) && $config_app['multilingual'] == 'on') {
            if (!empty($clean_path[0]) && array_key_exists($clean_path[0], $config_langs['list'])) {
                $user_lang = $clean_path[0];
                array_shift($clean_path);
            }
            $target_path .= '/' . $user_lang . (empty($clean_path) ? '' : '/') . implode('/', $clean_path);
        } else {
            $target_path .= '/' . implode('/', $clean_path);
        }

        $page_data = $this->searchPath($config_routes['list'], $clean_path);

        if (empty($page_data)) {
            Header::setHttpCode(404);
        }

        if ((explode('?', $_SERVER['REQUEST_URI']))[0] !== $target_path) {
            Header::setHttpCode(301, $target_path);
        }
        
        $controller = $page_data['controller'];
        $method = $page_data['method'];
        $page_data['clean_path'] = ('/' . implode('/', $clean_path));
        $page_data['current_path'] = $target_path;
        $page_data['url'] = $this->url($target_path);
        $page_data['host'] = $this->url();
        $page_data['lang'] = $user_lang;

        (new  $controller($page_data))->$method();
    }

    /**
     * Генерирует url адрес
     *
     * Генерирует и возвращает путь вида https://zzila.com/[lang]$request
     * 
     * @param string $request `[опционально]` Путь вида /to/path
     * 
     * @return string 
     */
    private function url(string $request = ''): string
    {
        $isHttps = !empty($_SERVER['HTTPS']) && 'off' !== strtolower($_SERVER['HTTPS']);
        return ('http' . ($isHttps ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $request);
    }

    /**
     * Разбить $_SERVER['REQUEST_URI'] на массив
     *
     * Разбивает $_SERVER['REQUEST_URI'] на массив по /, игнорирую пустоты
     * Если https://zzila.com/ru///to/path?query=hi, то array = 0 => ru, 1 => to, 2 => path
     *  
     * @return array 
     */
    private function getCleanPath(): array
    {
        $current_request = (explode('?', $_SERVER['REQUEST_URI']))[0];
        return array_values(array_diff(explode("/", $current_request), array('')));
    }

    /**
     * Получает язык пользователя с учетом доступных в конфигурации
     *
     * Получает язык из COOKIE или HTTP_ACCEPT_LANGUAGE,
     * если такой язык есть в конфигурации, то возвращает его,
     * если нет, то возвращает стандартный из конфигурации
     * 
     * @param array $config_langs массив конфигурации langs
     *  
     * @return string 
     */
    private function getLang(array $config_langs): string
    {
        $lang = $config_langs['default'] ?? 'ru';
        if (!empty($_COOKIE['lang']) && array_key_exists($_COOKIE['lang'], $config_langs['list'])) {
            $lang = $_COOKIE['lang'];
        } else {
            if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) && ($list = strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']))) {
                $tmp = explode(';', $list)[0];
                $tmp = explode(',', $tmp)[1];
                if ($tmp != null) {
                    if (array_key_exists($tmp, $config_langs['list'])) {
                        $lang = $tmp;
                    }
                }
            }
        }
        return $lang;
    }

    /**
     * Ищет текущий путь в конфигурации routes
     *
     * Ищет $path в $routes['uri'], если находит, то возвращает весь массив пути из $routes
     * 
     * @param array $routes список путей из конфигурации routes
     * @param array $path текущий путь (из getCleanPath())
     *  
     * @return array 
     */
    private function searchPath(array $routes, array $current_path): array
    {
        $current = ('/' . implode('/', $current_path));
        $result = array();
        foreach ($routes as $route) {
            $path = str_replace('/', '\/', $route['path']);
            if (preg_match('/^' . $path . '$/i', $current, $matches)) {
                $route['id'] = $matches['id'] ?? 0;
                $result = $route;
                return $result;
            }
        }
        return $result;
    }
}
