<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 21.04.2018
 * Time: 17:13
 */

namespace app\models;


class OrderItem extends DataEntity
{
    private $product;
    private $order_id;
    private $item_id;
    private $quantity = 0;
    /**
     * OrderItem constructor.
     * @param Product $product
     * @param mixed $quantity
     */
    public function __construct(Product $product, $quantity)
    {
        $this->product = $product;
        $this->item_id = $product->getId();
        $this->quantity = $quantity;
    }

    /**
     * @param mixed $order_id
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
    }


    /**
     * @return null
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $this->quantity + $quantity;
    }


}