<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 21.04.2018
 * Time: 17:13
 */

namespace app\models;


class Category extends DbModel
{
    private $name = "";

    public static function getTableName()
    {
        return 'categories';
    }

    public function __construct($name = null)
    {
        parent::__construct();
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
