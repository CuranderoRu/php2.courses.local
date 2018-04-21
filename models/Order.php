<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 21.04.2018
 * Time: 17:12
 */

namespace app\models;


class Order extends User
{
    private $user;
    private $productList = [];

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function save(){
        //сохранить свойства в ИБ и присвоить id заказу
        return 1;
    }

    public function getTableName()
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


    public static function getByID($id)
    {
        $sql = new Db();
        $id = $sql->checkParam($id);
        $params = $sql->selectOne("SELECT * FROM orders WHERE id = {$id}");
        if (is_null($params['id'])){
            return null;
        }else{
            $p = new Product();
            $p->initializeProduct($params);
            return $p;
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