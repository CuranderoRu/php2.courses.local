<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 21.04.2018
 * Time: 17:12
 */

namespace app\models;


class Order extends Model
{
    private $user;
    private $productList = [];

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function save(){
        //сохранить свойства в ИБ и присвоить id заказу
        return 1;
    }

    public static function getTableName()
    {
        return 'orders';
    }

    public function addProduct(Product $product, $quantity = 1){
        if ($quantity==0){
            return;
        }
        if (!$product->isInit()){
            return;
        }
        $currentProduct = $this->productList[$product->getId()];
        if (is_null($currentProduct)){
            $this->productList[$product->getId()] = new OrderItem($product,$quantity);
        }else{
            $currentProduct->setQuantity($currentProduct->getQuantity()+$quantity);
        }
    }

    private function obtainParams($id, $params = null)
    {
        if (is_null($params)){
            $params = $this->getOne($id);
        }
        $this->id = $params['id'];
        return $params['id'];
    }
}