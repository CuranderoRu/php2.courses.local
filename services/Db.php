<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 21.04.2018
 * Time: 17:09
 */

namespace app\services;


class Db
{
    /** @var \PDO */
    private $conn = null;

    private $config;

    /**
     * Db constructor.
     */
    public function __construct($driver, $host, $login, $password, $database, $charset = "utf8")
    {
        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['login'] = $login;
        $this->config['password'] = $password;
        $this->config['database'] = $database;
        $this->config['charset'] = $charset;
    }


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
        //echo 'DB::executeSQL <br>';
        $pdoStatement = $this->getConnection()->prepare($query_text);
        $pdoStatement->execute($params);
        //var_dump($pdoStatement->errorInfo());
        return $pdoStatement;
    }

    public function execute($query_text, $params = []){
        //echo 'DB::execute <br>';
        return $this->executeSQL($query_text, $params);
    }

    function selectAll($sql, $params = []){
        //echo 'DB::selectAll <br>';
        $res = $this->execute($sql, $params);
        //var_dump($res);
        return $res->fetchAll();
    }

    function selectOne($sql, $params = []){
        //echo '<p>DB::selectOne</p>';
        return $this->selectAll($sql, $params)[0];
    }

    public function queryObject($sql, $params, $class)
    {
        //echo 'DB::queryObject <br>';
        $smtp = $this->executeSQL($sql, $params);
        $smtp->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        return $smtp->fetch();
    }

    public function queryObjects($sql, $params, $class)
    {
        //echo 'DB::queryObject <br>';
        $smtp = $this->executeSQL($sql, $params);
        $smtp->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        return $smtp->fetchAll();
    }

    public function lastInsertId()
    {
        return $this->conn->lastInsertId();
    }


}