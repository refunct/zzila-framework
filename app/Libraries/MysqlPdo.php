<?php

namespace App\Libraries;

use App\Libraries\Error as Error;

class MysqlPdo
{

    public const RETURN_SELECT = 1;
    public const RETURN_FETCH_COLUMN = 2;
    public const RETURN_INSERT = 3;
    public const RETURN_UPDATE = 4;

    private static $pdo;

    public function __construct()
    {
        if (!defined('PDO::ATTR_DRIVER_NAME')) {
            Error::set('Драйвер базы данных не поддерживается');
        }
    }

    /**
     * Подключение к базе данных 
     * 
     * @param array &$data Должен содержать $data['host'],$data['dbname'],$data['charset'],$data['user'],$data['password']
     * 
     * @return void
    */
    public function connect(array &$data): void
    {
        if (empty(self::$pdo)) {
            try {
                $dsn = 'mysql:host=' . $data['host'] . ';dbname=' . $data['dbname'] . ';charset=' . $data['charset'];
                $opt = [
                    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::ATTR_EMULATE_PREPARES   => false,
                ];
                self::$pdo = new \PDO($dsn, $data['user'], $data['password'], $opt);
            } catch (\PDOException $e) {
                Error::set("Не получилось подключиться к базе данных");
            }
        }
    }

    /**
     * Запрос к базе данных
     * 
     * @param string $sql SQL запрос
     * @param array $data данные для подготовленного выражения
     * @param int $type Тип возвращаемого значения MysqlPdo::`RETURN_SELECT`|`RETURN_FETCH_COLUMN`|`RETURN_INSERT`|`RETURN_UPDATE`
     * 
     * @return array
    */
    public function sql(string $sql, array $data = array(), int $type = self::RETURN_SELECT): array
    {
        if (empty(self::$pdo)) {
            Error::set('База данных не подключена');
        }

        $result = array('status' => 'error', 'data' => array());

        try {
            $stmt = self::$pdo->prepare($sql);
            $stmt->execute($data);
            switch ($type) {
                case self::RETURN_SELECT:
                    $result['data'] = $stmt->fetchAll();
                    break;
                case self::RETURN_FETCH_COLUMN:
                    $result['data'] = $stmt->fetchColumn();
                    break;
                case self::RETURN_INSERT:
                    $result['data'] = self::$pdo->lastInsertId();
                    break;
                case self::RETURN_UPDATE:
                    $result['data'] = $stmt->rowCount();
                    break;
                default:
                    $result['data'] = $stmt->fetch();
                    break;
            }
            $result['status'] = 'success';
        } catch (\PDOException $e) {
            $result['data'] = $e;
        }
        return $result;
    }
}
