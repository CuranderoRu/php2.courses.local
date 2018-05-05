<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 28.04.2018
 * Time: 23:20
 */

namespace app\controllers;


use app\models\repositories\CommentRepository;
use app\models\repositories\ProductRepository;
use app\services\Request;

class ProductController extends Controller
{

    public function actionIndex(){
        $filter = [];
        if (isset($_GET['category_id'])){
            //$filter = [':category'=>$_GET['category_id']];
            $filter = [':category'=>Request::getInstance()->getParams()['category_id']];
        }
        $products = (new ProductRepository())->getAll($filter);
        $cart_actions_visibility =  "invisible";
        $shop_actions_visibility = $this->session->isAuthenticated() ? "" : "invisible";
        echo $this->render('card', [
            'products'=>$products,
            'cart_actions_visibility'=>$cart_actions_visibility,
            'shop_actions_visibility'=>$shop_actions_visibility
            ]);
    }

    public function actionDisplay(){
        $this->useLayout = false;
        $id = Request::getInstance()->getParams()['id'];
        $product = (new ProductRepository())->getByID($id);
        $comments = (new CommentRepository())->getAll([':item'=>$id]);
        echo $this->render('itempage', [
                                                'product'=>$product,
                                                'comments'=>$comments
                                                ]);
    }

    public function actionCard(){
        $products = [];
        $cart_actions_visibility = $this->session->isAuthenticated() ? "invisible" : "";
        $shop_actions_visibility = $this->session->isAuthenticated() ? "" : "invisible";
        var_dump($shop_actions_visibility);
        $id = Request::getInstance()->getParams()['id'];
        $products[] = (new ProductRepository())->getByID($id);
        echo $this->render('card', [
            'products'=>$products,
            'cart_actions_visibility'=>$cart_actions_visibility,
            'shop_actions_visibility'=>$shop_actions_visibility
            ]);
    }


}