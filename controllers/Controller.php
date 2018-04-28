<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 29.04.2018
 * Time: 0:41
 */

namespace app\controllers;


use app\models\Category;

abstract class Controller
{
    private $action;
    private $defaultAction = 'index';
    private $layout = "shop";
    private $useLayout = true;

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
        ob_start();
        extract($params);
        $templatePath = TEMPLATES_DIR . DS . $template . ".php";
        include $templatePath;
        return ob_get_clean();
    }


}