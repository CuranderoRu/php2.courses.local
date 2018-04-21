<?php
header('Content-Type: text/html;charset=utf-8');
include $_SERVER['DOCUMENT_ROOT'] . "/../services/Autoloader.php";

spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

$product = new \app\models\Product(1);
session_start();

var_dump($product);

$user = new \app\models\User('Vasya');
$user->authenticate('123');

var_dump($_SESSION['user']);

$order = new \app\models\Order($user);

$order->addProduct($product,1);
$order->addProduct($product,1);
$order->addProduct($product,1);

var_dump($order);