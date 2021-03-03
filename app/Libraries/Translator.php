<?php

namespace App\Libraries;

use App\Libraries\Loader;

class Translator
{
    use Loader;

    private $translations = array();

    public function __construct(string $lang)
    {
        $this->translations = $this->loadFile(TRANSLATIONS_PATH . '/' . $lang . '.php');
    }

    /**
     * Возвращает перевод по имени
     * 
     * @param string $name Имя перевода
     * 
     * @return string|int
    */
    public function getTranslate(string $name): string|int
    {
        return $this->translations[$name]??'';
    }
}
