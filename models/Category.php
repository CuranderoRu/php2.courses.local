<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 21.04.2018
 * Time: 17:13
 */

namespace app\models;


class Category extends Model
{
    private $name = "";

    public static function getTableName()
    {
        return 'categories';
    }

    public function __construct($id = null)
    {
        if (!is_null($id)){
            $this->id = $id;
            $this->obtainParams();
        }
    }

    private function obtainParams($params = null){
        if (is_null($params)){
            $params = $this->getOne();
        }
        $this->id = $params['id'];
        $this->name = $params['name'];
        return $params['id'];
    }


    public function save()
    {
        // TODO: Implement save() method.
    }
}