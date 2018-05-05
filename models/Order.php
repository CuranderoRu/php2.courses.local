<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 21.04.2018
 * Time: 17:12
 */

namespace app\models;


use app\models\repositories\OrderItemRepository;
use app\models\repositories\OrderRepository;

class Order extends DataEntity
{
    private $user;
    private $user_id;
    private $isFinalized = 0;
    private $productList = [];

    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    public function finalizeOrder()
    {
        $this->user_id = $this->user->getId();
        $this->isFinalized = 1;
        (new OrderRepository())->save($this);
        /**
         * @var  $key
         * @var OrderItem $value
         */
        foreach ($this->productList as $key => $value){
            $value->setOrderId($this->getId());
            (new OrderItemRepository())->save($value);
        }

    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
        $this->user_id = $this->user->getId();
    }

    public function getCartItems(){
        $products = [];
        foreach ($this->productList as $key=>$value){
            $products[$key] = $value->getProduct();
        }
        return $products;
    }

    public function getItemsQuantity()
    {
        return count($this->productList);
    }

    public function addProduct(Product $product, $quantity){
        if ($quantity<=0){
            return false;
        }
        $currentProduct = $this->productList[$product->getId()];
        if (is_null($currentProduct)){
            $this->productList[$product->getId()] = new OrderItem($product,$quantity);
        }else{
            $currentProduct->setQuantity($quantity);
        }
        return true;
    }

}