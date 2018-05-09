<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 09.05.2018
 * Time: 22:09
 */

namespace app\base;


class Storage
{
    protected $items;

    public function set($key, $object)
    {
        $this->items[$key] = $object;

    }

    public function get($key)
    {
        if (!isset($this->items[$key])){
            //хранилище не должно создавать объекты
            $this->items[$key] = App::call()->createComponent($key);
        }
        return $this->items[$key];
    }
}