<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 04.05.2018
 * Time: 20:46
 */

namespace app\models\repositories;

use app\models\entities\Product;
use app\models\Repository;

class ProductRepository extends Repository
{
    public function getTableName()
    {
        return 'items';
    }

    public function getEntityClass()
    {
        return Product::class;
    }


}