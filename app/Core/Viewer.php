<?php

namespace App\Core;

use App\Core\Config as Config;
use App\Libraries\Translator as Translator;
use App\Libraries\Loader as Loader;

class Viewer
{
    use Loader;

    private $translator;
    private $template;
    private $data = array();
    private $page_data = array();
    private $page_settings = array('title' => '', 'description' => '', 'image' => '', 'keywords' => '');

    public function __construct(array &$page_data)
    {
        $this->page_data = &$page_data;
        $this->template = $page_data['template'];
        if (Config::get('app', 'multilingual') == 'on') {
            $this->translator = new Translator($page_data['lang']);
        }
        $this->setTitle($this->t($this->getPageData('name') . '_title'));
        $this->setDescription($this->t($this->getPageData('name') . '_description'));
        $this->setImage('/images/' . $this->getPageData('template') . '/icon/favicon-194x194.png');
        $this->setKeywords($this->t($this->getPageData('name') . '_keywords'));
    }

    public function setTitle(string $title): void
    {
        $this->page_settings['title'] = $title;
    }
    public function setDescription(string $description): void
    {
        $this->page_settings['description'] = $description;
    }
    public function setImage(string $image, bool $set_host = true): void
    {
        $this->page_settings['image'] = ($set_host ? $this->getPageData('host') : '') . $image;
    }
    public function setKeywords(string $keywords): void
    {
        $this->page_settings['keywords'] = $keywords;
    }

    public function getTitle(): string
    {
        return $this->page_settings['title'];
    }
    public function getDescription(): string
    {
        return $this->page_settings['description'];
    }
    public function getImage(): string
    {
        return $this->page_settings['image'];
    }
    public function getKeywords(): string
    {
        return $this->page_settings['keywords'];
    }

    /**
     * Выводит print_r на экран
     *
     * Выводит на экран, если тип сайта не production
     * 
     * @param mixed &$data Данные для вывода
     * 
     * @return void 
     */
    public static function debug(mixed $data): void
    {
        if (SITE_TYPE !== 'production') {
            echo '<pre style="background: #ffffff; color: #000000; font-size: 12px;">' . print_r($data, true) . '</pre>';
        }
    }

    /**
     * Выводит var_dump на экран
     *
     * Выводит на экран, если тип сайта не production
     * 
     * @param mixed &$data Данные для вывода
     * 
     * @return void 
     */
    public static function dump(mixed $data): void
    {
        if (SITE_TYPE !== 'production') {
            var_dump($data);
        }
    }

    /**
     * Выводит json_decode на экран
     * 
     * @param mixed &$data Данные для вывода
     * 
     * @return void 
     */
    public function renderJson(array &$data): void
    {
        echo json_decode($data);
    }

    /**
     * Выводит шаблон на экран
     * 
     * @return void 
     */
    public function renderHtml(): void
    {
        $this->loadFile(TEMPLATES_PATH . '/' . $this->template . '/html.php');
    }

    /**
     * Выводит страницу на экран
     * 
     * @param string $name Имя страницы TEMPLATES_PATH/template/pages/{$name}.php
     * 
     * @return void 
     */
    public function renderPage(string $name): void
    {
        $this->loadFile(TEMPLATES_PATH . '/' . $this->template . '/pages/' . $name . '.php');
    }

    /**
     * Выводит слой на экран
     * 
     * @param string $name Имя слоя TEMPLATES_PATH/template/layers/{$name}.php
     * 
     * @return void 
     */
    public function renderLayer(string $name): void
    {
        $this->loadFile(TEMPLATES_PATH . '/' . $this->template . '/layers/' . $name . '.php');
    }

    /**
     * Устанавливает имя шаблона
     * 
     * @param string $name Имя шаблона
     * 
     * @return void 
     */
    public function setTemplate(string $name): void
    {
        $this->template = $name;
    }

    /**
     * Устанавливает данные
     * 
     * @param array &$data Массив данных
     * 
     * @return void 
     */
    public function setData(array &$data): void
    {
        $this->data = &$data;
    }

    /**
     * Возвращает данные страницы
     * 
     * @param string $name Имя нужного параметра
     * 
     * @return string 
     */
    public function getPageData(string $name): string
    {
        return $this->page_data[$name] ?? '';
    }

    /**
     * Возвращает перевод по имени
     * 
     * @param string $name Имя перевода
     * 
     * @return string 
     */
    public function t(string $name): string
    {
        if (!empty($this->translator)) {
            return $this->translator->getTranslate($name);
        } else {
            return '';
        }
    }

    /**
     * Генерирует ссылку
     * 
     * @param string $path `[опционально]` Путь вида /to/path
     * @param string $target_lang `[опционально]` Язык для ссылки в формате ISO 639-1
     * 
     * @return string 
     */
    public function link(string $path = '', string $target_lang = ''): string
    {
        $url = $this->getPageData('host');

        $lang = $this->getPageData('lang');

        if (!empty($target_lang)) {
            $lang = $target_lang;
        }

        if (Config::get('app', 'multilingual') == 'on') {
            $url .= '/' . $lang;
        }
        return $url . $path;
    }

    /**
     * Возвращает данные по имени
     * 
     * @param string $name Имя данных
     * 
     * @return mixed 
     */
    public function d(string $name): mixed
    {
        return $this->data[$name] ?? '';
    }

    /**
     * Возвращает конфигурацию
     * 
     * @param string $config_name Имя конфигурации
     * 
     * @return mixed 
     */
    public function getConfig(string $config_name, string $key = ''): mixed
    {
        return Config::get($config_name, $key);
    }
}
