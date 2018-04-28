<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 21.04.2018
 * Time: 17:12
 */

namespace app\models;


class Order extends DbModel
{
    private $user;
    private $isFinalized = 0;

    public function __construct(User $user = null)
    {
        parent::__construct();
        $this->user = $user;
    }

    public function finalizeOrder()
    {
        $this->isFinalized = 1;
        $this->save();
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

}