<?php
require_once ENGINE_DIR . "/basic_classes.php";

//$product = new Product(1);
$product = Product::getProductByID(1);
session_start();

var_dump($product);

$user = new User('Vasya');
$user->authenticate('123');

var_dump($_SESSION['user']);

$order = new Order($user);

$order->addProduct($product,1);
$order->addProduct($product,1);
$order->addProduct($product,1);

var_dump($order);