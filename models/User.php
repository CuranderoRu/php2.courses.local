<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 21.04.2018
 * Time: 17:11
 */

namespace app\models;
use app\services\Db;

class User extends DbModel
{
    private $name;
    private $login;
    private $password;
    private $authenticated = false;

    public static function getCurrentUser(){
        return $_SESSION['user'];
    }

    public function __construct($login)
    {
        $this->login = $login;
    }

    public function authenticate($password){
        $sql = Db::getInstance();
        if($user = $sql->selectOne("SELECT * FROM users WHERE login = :login AND password = :password",
            [
            ':login' => $this->login,
            ':password' => $password
            ]
        )
        )
        {
            $this->id = $user['id'];
            $this->name = $user['name'];
            $_SESSION['user'] = $this;
            $sql->execute("UPDATE users SET last_login = :last_login WHERE id= :id",
                [
                ':last_login' => date('c'),
                ':id' => $user['id']
                ]
            );
            $this->authenticated = true;
        }
    }

    public function isAuthenticated(){
        return $this->authenticated;
    }


    public static function getTableName()
    {
        return 'users';
    }

    public static function getByID($id)
    {
        $sql = Db::getInstance();
        $params = $sql->selectOne("SELECT * FROM users WHERE id = :id", [':id'=>$id]);
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

    public function save()
    {
        $arr = [
            ':name' => $this->name,
            ':login' => $this->login,
            ':password' => $this->password,
            ':last_login' => date('c')
        ];
        if(!$this->isExists()){
            $this->createRecord($arr);
        }else{
            $arr[':id'] = $this->id;
            $this->updateRecord($arr);
        };
        return true;

    }
}