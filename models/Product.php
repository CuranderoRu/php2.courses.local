<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 21.04.2018
 * Time: 17:11
 */

namespace app\models;

use app\services\Db;

class Product extends Model
{
    protected $image_name;
    protected $name;
    protected $description;
    protected $price;
    protected $category;

    public static function getByID($id){
        $sql = new Db();
        $id = $sql->checkParam($id);
        $params = $sql->selectOne("SELECT * FROM items WHERE id = {$id}");
        if (is_null($params['id'])){
            return null;
        }else{
            $p = new Product();
            $p->initialize($params);
            return $p;
        }
    }

    public function getTableName()
    {
        return 'items';
    }

    public function __construct($id=null)
    {
        if (!is_null($id)){
            $this->id = $this->obtainParams($id);
        }
    }

    public function isInit(){
        return !is_null($this->id);
    }

    private function obtainParams($id, $params = null){
        if (is_null($params)){
            $params = $this->getOne($id);
        }
        $this->id = $params['id'];
        $this->image_name = $params['image'];
        $this->name = $params['name'];
        $this->description = $params['comment'];
        $this->price = $params['price'];
        $this->category = $params['category'];
        return $params['id'];
    }

    public function setImageName($image_name)
    {
        $this->image_name = $image_name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function save(){
        //сохранить свойства в ИБ и присвоить id товару
        return true;
    }


}