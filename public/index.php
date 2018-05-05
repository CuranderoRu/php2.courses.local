<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html;charset=utf-8');
include_once $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../services/Autoloader.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../vendor/autoload.php";



spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

/** @var \app\services\Request $request */
$request = \app\services\Request::getInstance();
$controllerName = $request->getControllerName() ?: DEFAULT_CONTROLLER;
$actionName = $request->getActionName();

$controllerClass = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)){
    $session = \app\services\Session::getInstance();
    /** @var \app\controllers\Controller $controller */
    $controller = new $controllerClass(new \app\services\Renderer(), $session);
    $controller->runAction($actionName);
}