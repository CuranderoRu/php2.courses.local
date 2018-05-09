<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 05.05.2018
 * Time: 17:42
 */

namespace app\controllers;

use app\base\App;

class UserController extends Controller
{
    public function actionIndex(){
        $this->useLayout = false;
        echo $this->render('myaccountinfo', [
            'user'=>$this->session->getUser()
        ]);
    }

    public function actionLogin(){
        if (App::call()->request->getMethod()=="GET"){
            $this->useLayout = false;
            echo $this->render('login', [
                'message'=>"Здравствуйте!"
            ]);
        }else{
            $login = App::call()->request->getParams()['login'];
            $password = App::call()->request->getParams()['password'];
            if($this->session->authenticate($login, $password)){
                header('Location: http://'.$_SERVER['HTTP_HOST']);
            }else{
                echo "Что-то пошло не так. Попробуйте еще раз";
            }
        }
    }

    public function actionRegister(){
        echo "actionRegister";
    }

    public function actionLogoff(){
        $this->session->close();
        header('Location: http://'.$_SERVER['HTTP_HOST']);
    }


}