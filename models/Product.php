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

    public function getTableName()
    {
        return 'items';
    }

    public function __construct($id = null)
    {
        if (!is_null($id)){
            $this->id = $id;
            $this->obtainParams();
        }
    }

    public function isInit(){
        return !is_null($this->id);
    }

    private function obtainParams($params = null){
        if (is_null($params)){
            $params = $this->getOne();
        }
        $this->id = $params['id'];
        $this->image_name = $params['image'];
        $this->name = $params['name'];
        $this->description = $params['comment'];
        $this->price = $params['price'];
        if (is_null($params['category'])){
            $this->category = new Category();
        }else{
            $this->category = new Category($params['category']);
        }
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
        $arr = [
            ':category' => $this->category->getId(),
            ':comment' => $this->description,
            ':image' => $this->image_name,
            ':name' => $this->name,
            ':price' => $this->price
        ];
        if(!$this->isExists()){
            $this->createRecord($arr);
        }else{
            $arr[':id'] = $this->id;
            $this->updateRecord($arr);
        };
        return true;
    }


}