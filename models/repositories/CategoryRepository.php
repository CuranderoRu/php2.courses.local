<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 04.05.2018
 * Time: 21:42
 */

namespace app\models\repositories;

use app\models\Category;
use app\models\Repository;


class CategoryRepository extends Repository
{
    public function getTableName()
    {
        return 'categories';
    }

    public function getEntityClass()
    {
        return Category::class;
    }

}