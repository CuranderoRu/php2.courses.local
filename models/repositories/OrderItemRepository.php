<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 06.05.2018
 * Time: 1:18
 */

namespace app\models\repositories;


use app\models\OrderItem;
use app\models\Repository;

class OrderItemRepository extends Repository
{
    public function getTableName()
    {
        return 'orderItems';
    }

    public function getEntityClass()
    {
        return OrderItem::class;
    }

}