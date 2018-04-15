<?php
require_once VENDOR_DIR . "/template.php";
require_once ENGINE_DIR . "/shop.php";
require_once ENGINE_DIR . "/user.php";


if(isset($_POST['login'])){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $redirect = 'shop/index.php';

    if(isset($_POST['redirect_arg'])){
        $redirect = $redirect . $_POST['redirect_arg'];
    }

    if(checkUser($login, $password)){
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$redirect);
    }
}else{
    login(null,'?action=myaccount');
}

?>
