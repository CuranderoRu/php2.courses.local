<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 29.04.2018
 * Time: 1:43
 */

namespace app\controllers;


use app\base\App;
use app\models\repositories\ProductRepository;

class CartController extends Controller
{
    public function actionIndex(){
        if (!$this->session->isAuthenticated()){
            header('Location: http://'.$_SERVER['HTTP_HOST'] . "/user/login");
            return;
        }
        $products = $this->session->getCartItems();
        $cart_actions_visibility = "";
        $shop_actions_visibility = "invisible";
        echo $this->render('card', [
            'products'=>$products,
            'cart_actions_visibility'=>$cart_actions_visibility,
            'shop_actions_visibility'=>$shop_actions_visibility
        ]);

    }

    public function actionFinalize()
    {
        $this->session->finalizeOrder();
        echo 'Order finalized';
    }

    public function actionAdd(){
        $receivedValue = null;
        foreach (App::call()->request->getPost() as $key=>$value){
            $receivedValue = $key;
        }
        if (is_null($receivedValue))return;
        if ($receivedValue=="")return;
        $obj = json_decode($receivedValue);
        $json = json_encode(["status" => "error", "message"=>"Что-то пошло не так. Товар не добавлен в корзину.", "id"=>$obj->id]);
        if (!is_null($obj)){
            $product = null;
            if ($product = (new ProductRepository())->getByID($obj->id)){
            //if ($product = (App::call()->getRepository("ProductRepository"))->getByID($obj->id)){
                $this->session->addToCart($product, $obj->quantity);
                $json = json_encode(["status" => "done", "message"=>"Товар " . $product->getName() . " в количестве " . $obj->quantity . " успешно добавлен в корзину.", "id"=>$obj->id]);
            }else{
                $json = json_encode(["status" => "error", "message"=>"Товар c id " . $obj->id . " не добавлен в корзину.", "id"=>$obj->id]);
            }
        };
        echo $json;

    }

}