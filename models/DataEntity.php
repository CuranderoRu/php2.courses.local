<?php
namespace app\models;


abstract class DataEntity extends Model
{
    protected $id;

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



    public function getId()
    {
        return $this->id;
    }


}