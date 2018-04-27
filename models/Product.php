<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 21.04.2018
 * Time: 17:11
 */

namespace app\models;

class Product extends Model
{
    protected $image;
    protected $name;
    protected $description;
    protected $price;

    /** @var  Category */
    protected $category;

    /**
     * Product constructor.
     * @param $image
     * @param $name
     * @param $description
     * @param $price
     * @param $category
     */
    public function __construct($image = null, $name = null, $description = null, $price = null, Category $category = null)
    {
        parent::__construct();
        $this->image = $image;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
    }

    public static function getTableName()
    {
        return 'items';
    }


    public function setImage($image_name)
    {
        $this->image = $image_name;
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
            ':category' => $this->category->id,
            ':comment' => $this->description,
            ':image' => $this->image,
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