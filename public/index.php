<?php
define("ROOT_PATH", dirname(__DIR__));
define("VENDOR_PATH", ROOT_PATH . '/vendor');
define("APP_PATH", ROOT_PATH . '/app');
define("PUBLIC_PATH", ROOT_PATH . '/public');
define("TEMPLATES_PATH", APP_PATH . '/Templates');
define("TRANSLATIONS_PATH", APP_PATH . '/Translations');
define("SITE_TYPE", $_SERVER['SITE_TYPE'] ?? 'production');
define("CONFIGS_PATH", APP_PATH . '/Configs/' . SITE_TYPE);

require(dirname(__DIR__) . '/vendor/autoload.php');

$router = new App\Core\Router;
$router->routing();