<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 29.04.2018
 * Time: 0:41
 */

namespace app\controllers;


use app\interfaces\IRenderer;
use app\models\Category;

abstract class Controller
{
    private $action;
    private $defaultAction = 'index';
    private $layout = "shop";
    protected $useLayout = true;
    private $renderer;

    /**
     * Controller constructor.
     * @param $renderer
     */
    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }


    public function runAction($action = null){
        $this->action = $action ?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if(method_exists($this, $method)){
            $this->$method();
        }else{
            echo "404";
        }

    }

    public function render($template, $params = []){
        if($this->useLayout){
            $categories = Category::getAll();
            return $this->renderTemplate("layouts/{$this->layout}",
                [
                    'shopcategories'=>$this->renderTemplate('categoryitems', ['categories'=>$categories]),
                    'itemscontent'=>$this->renderTemplate($template, $params)
                ]);
        }else{
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = []){
        return $this->renderer->render($template, $params);
    }




}