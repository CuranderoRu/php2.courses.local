<?php
header('Content-Type: text/html;charset=utf-8');
include_once $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../services/Autoloader.php";

spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

$product = new \app\models\Product(1);
$product->setDescription('Новое описание этого товара');
$product->setImageName('newimage.jpg');
$product->setName('Новое имя товара');
$product->setPrice(199.99);
$product->save();

var_dump($product);

$product->setDescription('Мегаклассные джинсы');
$product->setImageName('fox-1.jpg');
$product->setName('Супер длинные джинсы 1');
$product->setPrice(99.98);
$product->save();

var_dump($product);

exit;
session_start();
$user = new \app\models\User('Vasya');
$user->authenticate('123');

var_dump($_SESSION['user']);

$order = new \app\models\Order($user);

$order->addProduct($product,1);
$order->addProduct($product,1);
$order->addProduct($product,1);

var_dump($order);