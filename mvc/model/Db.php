<?php

namespace mvc\model;

use PDO;

/**
 * Class Db
 *
 *
 *
 * @package mvc\model
 */
class Db
{
    /**
     * PDO instance connected to database
     *
     * @var instance
     */
    protected $db;

    /**
     * Store value of created instance to ensure this class is singletone
     *
     * @var instance|null
     */
    private static $instance = null;

    public static function getInstance()
    {
        if(self::$instance === null){
            self::$instance = new self();
        }
    return self::$instance;
    }

    /**
     * Creates PDO connection instance with given settings(CONSTANTS) from 'settings.php' file
     */
    public function __construct()
    {
        $this->db = new PDO(
            'mysql:host='.DB['host'].'; dbname='.DB['dbname']. '; charset=utf8',
            DB['user'],
            DB['password'],
            [PDO::ATTR_ERRMODE => (DEBUG) ? PDO::ERRMODE_EXCEPTION : PDO::ERRMODE_SILENT]
        );
        var_dump(DB);
    }

    /**
     * @param $sql
     * @param array $params
     * @return array
     */
    public function execQuery($sql, $params = [])
    {
        $query = $this->db->prepare($sql);
        foreach ($params as $key => $value) {
            $query->bindValue(':'.$key, $value);
        }
        $res = $query->execute();
        return ['res' => $res, 'query' => $query];
    }

    /**
     * @param $sql
     * @param array $params
     * @return mixed
     */
    public function getRows($sql, $params = [])
    {
        $query = $this->execQuery($sql, $params)['query'];
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $sql
     * @param array $params
     * @return mixed
     */
    public function getColumns($sql, $params = [])
    {
        $query = $this->execQuery($sql, $params)['query'];
        return $query->fetchColumn();
    }
}