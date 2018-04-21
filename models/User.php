<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 21.04.2018
 * Time: 17:11
 */

namespace app\models;
use app\services\Db;

class User extends Model
{
    private $name;
    private $login;
    private $authenticated = false;

    public static function getCurrentUser(){
        return $_SESSION['user'];
    }

    public function __construct($login)
    {
        $this->login = $login;
    }

    public function authenticate($password){
        $sql = new Db();
        $login = $sql->checkParam($this->login);
        $password = $sql->checkParam($password);
        if($user = $sql->selectOne("SELECT * FROM users WHERE login = '{$login}' AND password = '{$password}'")){
            $this->id = $user['id'];
            $this->name = $user['name'];
            $_SESSION['user'] = $this;
            $sql->executeSQL("UPDATE users SET last_login = '{date('c')}' WHERE id={$user['id']}");
            $this->authenticated = true;
        }
    }

    public function isAuthenticated(){
        return $this->authenticated;
    }


    public function getTableName()
    {
        return 'users';
    }

    public static function getByID($id)
    {
        $sql = new Db();
        $id = $sql->checkParam($id);
        $params = $sql->selectOne("SELECT * FROM users WHERE id = {$id}");
        if (is_null($params['id'])){
            return null;
        }else{
            $p = new User($params['id']);
            $p->initialize($params);
            return $p;
        }

    }

    private function obtainParams($id, $params = null)
    {
        if (is_null($params)){
            $params = $this->getOne($id);
        }
        $this->id = $params['id'];
        $this->name = $params['name'];
        $this->login = $params['login'];
        return $params['id'];
    }

}