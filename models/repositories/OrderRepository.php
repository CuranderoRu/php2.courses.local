<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 04.05.2018
 * Time: 22:07
 */

namespace app\models\repositories;


use app\models\Order;
use app\models\Repository;

class OrderRepository extends Repository
{
    public function getTableName()
    {
        return 'orders';
    }

    public function getEntityClass()
    {
        return Order::class;
    }

}