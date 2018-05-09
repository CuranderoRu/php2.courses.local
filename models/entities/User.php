<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 21.04.2018
 * Time: 17:11
 */

namespace app\models\entities;

use app\models\DataEntity;

class User extends DataEntity
{
    private $name;
    private $login;
    private $password;
    private $authenticated = false;
    private $last_login;

    public static function getCurrentUser(){
        return $_SESSION['user'];
    }

    public function __construct($login = null)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $last_login
     */
    public function setLastLogin($last_login)
    {
        $this->last_login = $last_login;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param bool $authenticated
     */
    public function setAuthenticated($authenticated)
    {
        $this->authenticated = $authenticated;
    }

    /**
     * @param null $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }



    public function isAuthenticated(){
        return $this->authenticated;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

}