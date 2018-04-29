<?php
header('Content-Type: text/html;charset=utf-8');
include_once $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../services/Autoloader.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../vendor/autoload.php";



spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

$controllerName = $_GET['c'] ?: DEFAULT_CONTROLLER;
$actionName = $_GET['a'];

$controllerClass = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)){
    /** @var  $controller */
    $controller = new $controllerClass(new \app\services\Renderer());
    $controller->runAction($actionName);
}