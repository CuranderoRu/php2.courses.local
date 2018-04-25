<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 21.04.2018
 * Time: 17:09
 */

namespace app\services;


use app\traits\TSingletone;

class Db
{
    use TSingletone;

    private $conn = null;

    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'Megashop',
        'charset' => 'utf8'
    ];




    private function prepareDsnString(){
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
            );
    }

    private function getConnection(){
        if($this->conn==null){
            $this->conn = new \PDO($this->prepareDsnString(),$this->config['login'],$this->config['password']);
            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->conn;
    }



    private function executeSQL($query_text, $params){
        $pdoStatement = $this->getConnection()->prepare($query_text);
        $pdoStatement->execute($params);
        //var_dump($pdoStatement->errorInfo());
        return $pdoStatement;
    }

    public function execute($query_text, $params = []){
        return $this->executeSQL($query_text, $params);
    }

    function selectAll($sql, $params = []){
        $res = $this->executeSQL($sql, $params);
        //var_dump($res);
        return $res->fetchAll();
    }

    function selectOne($sql, $params = []){
        return $this->selectAll($sql, $params)[0];
    }

}