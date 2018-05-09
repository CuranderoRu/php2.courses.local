<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 21.04.2018
 * Time: 17:13
 */

namespace app\models\entities;


use app\models\DataEntity;

class Category extends DataEntity
{
    private $name = "";

    public function __construct($name = null)
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->name;
    }


}
