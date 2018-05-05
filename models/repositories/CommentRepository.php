<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 04.05.2018
 * Time: 20:52
 */

namespace app\models\repositories;

use app\models\Comment;
use app\models\Repository;

class CommentRepository extends Repository
{
    public function getTableName()
    {
        return 'comments';
    }

    public function getEntityClass()
    {
        return Comment::class;
    }


}