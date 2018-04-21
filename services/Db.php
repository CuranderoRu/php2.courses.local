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
    static $conn;
    public function __construct()
    {
        if($this->conn==null){
            $this->conn = mysqli_connect(MYSQL_ADDRESS, MYSQL_LOGIN, MYSQL_PSW, MYSQL_DBNAME);
        }
    }
    public function checkParam($param){
        return mysqli_real_escape_string($this->conn, $param);
    }
    public function executeSQL($stmt){
        return mysqli_query($this->conn, $stmt);
    }

    function selectAll($sql){
        $res = $this->executeSQL($sql);
        //var_dump($res);
        if(count($res)>0){
            return mysqli_fetch_all($res, MYSQLI_ASSOC);
        }else{
            return [];
        }

    }

    function selectOne($sql){
        $res = $this->executeSQL($sql);
        //var_dump($res);
        return mysqli_fetch_array($res, MYSQLI_ASSOC);
    }

}