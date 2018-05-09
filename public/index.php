<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html;charset=utf-8');
define("DS", DIRECTORY_SEPARATOR);
//include_once $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../services/Autoloader.php";
include $_SERVER['DOCUMENT_ROOT'] . "/../vendor/autoload.php";



spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);
$config = include __DIR__ . "/../config/main.php";
try{
    \app\base\App::call()->run($config);
} catch (\app\services\BadRequestException $exception){
    echo "Неверный запрос!";
} catch (\app\controllers\IncorrectActionException $exception){
    echo "Запрошено неверное действие!";
}



/*
$request = \app\services\Request::getInstance();
$controllerName = $request->getControllerName() ?: DEFAULT_CONTROLLER;
$actionName = $request->getActionName();

$controllerClass = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)){
    $session = \app\services\Session::getInstance();
     $controller = new $controllerClass(new \app\services\Renderer(), $session);
    $controller->runAction($actionName);
}
*/