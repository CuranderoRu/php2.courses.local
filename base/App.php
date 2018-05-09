<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 08.05.2018
 * Time: 22:56
 */

namespace app\base;

use app\models\entities\Order;
use app\models\entities\User;
use app\services\Db;
use app\services\Renderer;
use app\services\Request;
use app\services\Session;
use app\traits\TSingletone;
/**
 * Class App
 * @package app\base
 * @property Request $request
 * @property Db $db
 * @property Session $session
 * @property User $user
 * @property Order $order
 */

class App
{
    use TSingletone;

    public $config;

    /** @var Storage */
    private $components = [];

    /** @var RepositoryStorage */
    private $repositories = [];

    private $controller;
    private $action;

    /**
     * @return static
     */
    public static function call()
    {
        return static::getInstance();
    }

    function getRepository($name)
    {
        return $this->repositories->get($name);
    }

    public function createRepository($name)
    {
        $class = $name . $this->config['twig_cache_dir'];
        if (class_exists($class)) {
            $reflection = new \ReflectionClass($class);
            return $reflection->newInstanceArgs();
        }
        return null;
    }


    public function createComponent($name)
    {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);
                $reflection = new \ReflectionClass($class);
                return $reflection->newInstanceArgs($params);
            }
        }
        return null;
    }


    public function run($config)
    {
        $this->config = $config;
        $this->components = new Storage();
        $this->repositories = new RepositoryStorage();
        $this->runController();
    }

    public function runController()
    {
        $this->controller = $this->request->getControllerName() ?: 'product';
        $this->action = $this->request->getActionName();

        $controllerClass = $this->config['controllers_namespaces'] . ucfirst($this->controller) . "Controller";

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass(new Renderer());
            $controller->runAction($this->action);
        }

    }

    function __get($name)
    {
        return $this->components->get($name);
    }


}