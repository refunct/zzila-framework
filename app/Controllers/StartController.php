<?php

namespace App\Controllers;

use App\Core\Config as Config;
use App\Libraries\MysqlPdo as Db;

class StartController extends Controller
{
    public function index()
    {
        
        $data = array();
        $data['styles'][] = $data['preload']['styles'][] = array(
            'link' => '/styles/' . $this->page['template'] . '/style.css',
            'as' => 'style',
            'type' => 'text/css',
            'addit' => ''
        );
        $data['scripts'][] = $data['preload']['scripts'][] = array(
            'link' => '/scripts/' . $this->page['template'] . '/script.js',
            'as' => 'script',
            'type' => 'text/javascript',
            'addit' => ''
        );
        $data['preload']['fonts'][] = array(
            'link' => '/styles/' . $this->page['template'] . '/fonts/Roboto.ttf',
            'as' => 'font',
            'type' => 'font/ttf',
            'addit' => 'crossorigin="anonymous"'
        );
        $data['preload']['fonts'][] = array(
            'link' => '/styles/' . $this->page['template'] . '/fonts/Orbitron.ttf',
            'as' => 'font',
            'type' => 'font/ttf',
            'addit' => 'crossorigin="anonymous"'
        );

        /*
            Работа с моделями

            $user = new \App\Models\User;
            print_r($user->getInfo());
        */
        
        /*
            Работа с базой данных

            $db_config = Config::get('db');
            $this->db->connect($db_config);
            $this->db->sql('SELECT * FROM `table` WHERE `id` = :id', array(':id' => 1), Db::RETURN_SELECT);

            Db::RETURN_SELECT - возвращает fetchAll()
            Db::RETURN_FETCH_COLUMN - возвращает fetchColumn()
            Db::RETURN_INSERT - возвращает $pdo->lastInsertId()
            Db::RETURN_UPDATE - возвращает rowCount()
         */

        $this->viewer->setData($data);
        $this->viewer->renderHtml();
    }
}
