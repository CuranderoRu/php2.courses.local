<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 21.04.2018
 * Time: 17:11
 */

namespace app\models;

class Product extends DataEntity
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
    public function __construct($image = null, $name = null, $description = null, $price = null, $category = null)
    {
        $this->image = $image;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return null
     */
    public function getPrice()
    {
        return $this->price;
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



}