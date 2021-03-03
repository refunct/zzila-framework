<?php

namespace App\Controllers;

use App\Core\Viewer as Viewer;
use App\Libraries\MysqlPdo as Db;
use App\Libraries\Header as Header;
use App\Core\Config as Config;

class Controller
{
    protected $viewer;
    protected $db;
    protected $page;

    public function __construct(array &$page)
    {
        $this->page = &$page;
        $this->viewer = new Viewer($page);
        $this->db = new Db;
        
        Header::setLang($page['lang']);
        Header::setContent($page['mime'], Config::get('app')['charset']);
        Header::setRobotIndex($page['robot']);
        Header::setCookie('lang', $page['lang'], 31556926);
        if (!empty($_SERVER['QUERY_STRING'])) {
            Header::setCanonical($page['url']);
        }
    }
}
