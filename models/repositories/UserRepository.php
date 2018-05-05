<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 04.05.2018
 * Time: 22:12
 */

namespace app\models\repositories;


use app\models\Repository;
use app\models\User;

class UserRepository extends Repository
{

    public function getTableName()
    {
        return 'users';
    }

    public function getEntityClass()
    {
        return User::class;
    }

    public function authenticate(User $user, $password){
        if($res = $this->db->selectOne("SELECT * FROM users WHERE login = :login AND password = :password",
            [
                ':login' => $user->getLogin(),
                ':password' => $password
            ]
        )
        )
        {
            $user->setId($res['id']);
            $user->setName($res['name']);
            $user->setLastLogin($res['last_login']);
            $this->db->execute("UPDATE users SET last_login = :last_login WHERE id= :id",
                [
                    ':last_login' => date('c'),
                    ':id' => $res['id']
                ]
            );
            $user->setAuthenticated(true);
        }
    }


}