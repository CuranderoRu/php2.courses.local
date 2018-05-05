<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 29.04.2018
 * Time: 0:41
 */

namespace app\controllers;

use app\interfaces\IRenderer;
use app\models\repositories\CategoryRepository;
use app\services\Session;

abstract class Controller
{
    private $action;
    private $defaultAction = 'index';
    private $layout = "shop";
    protected $useLayout = true;
    private $renderer;
    protected $session;

    /**
     * Controller constructor.
     * @param IRenderer $renderer
     * @param Session $session
     */
    public function __construct(IRenderer $renderer, Session $session)
    {
        $this->renderer = $renderer;
        $this->session = $session;
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

    private function getCartMenuItems(){
        $items = [];
        if ($this->session->isAuthenticated()){
            if ($this->session->getCartQuantity()>0){
                $items['Finalize order']="../cart/finalize";
            }
            $items['My info']="../user";
            $items['Log off']="../user/logoff";
        }else{
            $items['Sign in']="../user/login";
            $items['Sign up']="../user/register";
        }
        return $items;
    }

    public function render($template, $params = []){
        if($this->useLayout){
            $categories = (new CategoryRepository())->getAll();
            return $this->renderTemplate("layouts/{$this->layout}",
                [
                    'shopcategories'=>$this->renderTemplate('categoryitems', ['categories'=>$categories]),
                    'itemscontent'=>$this->renderTemplate($template, $params),
                    'cart_menu_items'=>$this->getCartMenuItems()
                ]);
        }else{
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = []){
        return $this->renderer->render($template, $params);
    }




}