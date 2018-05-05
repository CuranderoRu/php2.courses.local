<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 04.05.2018
 * Time: 22:37
 */

namespace app\services;


use app\traits\TSingletone;

class Request
{
    use TSingletone;

    private $requestString;
    private $controllerName;
    private $actionName;
    private $params;
    private $post;
    private $method;

    private function init_instance()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";
        $this->method = $_SERVER['REQUEST_METHOD'];
        if (preg_match_all($pattern, $this->requestString, $matches)) {
            $this->controllerName = $matches['controller'][0];
            $this->actionName = $matches['action'][0];
            $this->params = $_REQUEST;
            $this->post = $_POST;
        }
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }



    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function getActionName()
    {
        return $this->actionName;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getMethod()
    {
        return $this->method;
    }
}